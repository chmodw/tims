<?php

namespace App\Http\Controllers;


use App\Document;
use App\ForeignProgram;
use App\Helpers;
use App\Program;
use App\TemplateManager;
use Illuminate\Http\Request;
use Exception;
use phpDocumentor\Reflection\Types\Array_;

class DocumentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Document-list');
        $this->middleware('permission:Document-create', ['only' => ['create','store', 'generate']]);
        $this->middleware('permission:Document-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Document-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('document.index');
    }

    /**
     * get document list as JSON
     * @return mixed
     * @throws Exception
     */
    public function get_documents()
    {

        $documentsWithProgramDetails = [];

        $documents = Document::all();

        foreach ($documents as $doc)
        {
            $programType = strtolower(str_replace('Program','_programs', $doc->program_type));

            $doc_program = Document::join($programType, $programType.'.program_id', 'documents.program_id')
                ->select($programType.'.program_type',$programType.'.program_title', 'documents.*')
                ->first();

            array_push($documentsWithProgramDetails, $doc_program);
        }

        return Datatables()->of($documentsWithProgramDetails)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                return '<a href="/document/' .$row->file_name . '/download"><i class="glyphicon glyphicon-save"></i></a>
                <form style="display: inline-block;" method="POST" action="'.route('document.destroy', $row->file_name) .'">'.
                    csrf_field().
                    method_field('DELETE').
                    '<button  class="btn btn-link" style="display: inline-block; color: red; padding: 0; margin-top: -8px;" onclick="return confirm("Are you sure?")"><i class="glyphicon glyphicon-trash"></i></button>'.
                '</form>';
            })
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Generate the document
         */
        $file_name = $this->generate($request);

        /**
         * save document data in the database
         */
        $document = new Document();

        $document->program_id = $request->program_id;
        $document->program_type = $request->program_type;
        $document->file_name = $file_name;
        $document->created_by = auth()->user()->email;

        $document->save();

        if($request->submit == 'Generate and Download'){
            /**
             * Download the document
             */
            return response()->download(storage_path('app/generated_documents/'.$file_name));
        }

        return redirect()->back()->with('success', ' Document Generated and save in the Storage');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }

    /**
     * Controll incomming generate requests
     *
     * @param Request $request
     * @param $id
     */
    public function generate(Request $request)
    {

        /**
         * get the controller class
         */
        $programController = app('App\Http\Controllers\\'.$request->program_type.'Controller');

        $traineeController = new TraineeController();

        $trainees = $traineeController->getTrainees($request->program_id);

        /*
         * Get program
         */
        $program =  app('App\Http\Controllers\ProgramController')->getProgram($request->program_type, $request->program_id);

//        return $program->notified_by;
        /**
         * Get the template
         */
        $template = TemplateManager::where('id',$request->doc_type)->first();

        $template_name = $template->file_name;

        try {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/templates/'.$template_name));
        }
        catch (exception $e) {
            return $e->getMessage();
        }

        /**
         * Fill the template program Variables
         */
        foreach (Helpers::var_array($templateProcessor->getVariables()) as $key => $value)
        {
            if(method_exists($programController, $value))
            {
                $templateProcessor->setValue($key, call_user_func_array([$programController, $value], [$program]));

            }
        }

        /**
         * New rows
         */
        $numberOfRows = sizeof($trainees);
        try {
            $templateProcessor->cloneRow('no', $numberOfRows);
        }catch (exception $e){

        }

        /**
         * Fill the template Trainee Variables
         */
        foreach (Helpers::var_array($templateProcessor->getVariables()) as $key => $value)
        {
            $i = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
            $templateProcessor->setValue('no#'.$i, $i);

            if(method_exists($traineeController, $value))
            {
                $templateProcessor->setValue($key, call_user_func_array([$traineeController, $value], [$trainees[($i-1)], $program->program_id]));

            }
        }


        $file_name = str_replace(" ", "-", $template->name.' TIMS'.strtotime('now').'.docx');


        try {
            /**
             * Store the document
             */
            $templateProcessor->saveAs(storage_path('app/generated_documents/'.$file_name));

        } catch (exception $e) {

            return redirect()->back()->with('failed', ' Could not save the Document...'.$e->getMessage());

        }
        /**
         * return generated document name
         */
        return $file_name;

    }

}
