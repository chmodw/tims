<?php

namespace App\Http\Controllers;


use App\ForeignProgram;
use App\Helpers;
use App\Program;
use App\TemplateManager;
use Illuminate\Http\Request;
use Exception;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

//        return $request;
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
          * New rows
         */
        $numberOfRows = sizeof($trainees);
        try {
            $templateProcessor->cloneRow('no', $numberOfRows);
        }catch (exception $e){

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

//        return $templateProcessor->getVariables();


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


        $file_name =$template->name.' TIMS'.strtotime('now').'.docx';


        try {
            /**
             * Store the document
             */
             $templateProcessor->saveAs(storage_path('app/generated_documents/'.$file_name));

        } catch (exception $e) {

            return redirect()->back()->with('failed', ' Could not save the Document...'.$e->getMessage());

        }

        if($request->submit == 'Generate and Download'){
            /**
             * Download the document
             */
            return response()->download(storage_path('app/generated_documents/'.$file_name));
        }

        return redirect()->back()->with('success', ' Document Generated and save in the Storage');

    }

}
