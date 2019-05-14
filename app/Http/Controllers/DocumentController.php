<?php

namespace App\Http\Controllers;


use App\ForeignProgram;
use App\Helpers;
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
        $controller = app('App\Http\Controllers\\'.$request->program_type.'Controller');
        /*
         * Get program
         */
        $program =  app('App\Http\Controllers\ProgramController')->getProgram($request->program_type, $request->program_id);
        /**
         * Get the template
         */
        $template = TemplateManager::find($request->doc_type)->first();

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
        $numberOfRows = 10;
        $templateProcessor->cloneRow('no', $numberOfRows);

        /**
         * Fill the template Variables
         */
        foreach (Helpers::var_array($templateProcessor->getVariables()) as $key => $value){

            if(method_exists($controller, $value)){

                $templateProcessor->setValue($key, call_user_func_array([$controller, $value], [$program]));

            }
        }
        /**
         * Store the document
         */
        $templateProcessor->saveAs(storage_path($template->name.' TIMS'.strtotime('now').'.docx'));
        /**
         * Download the document
         */
        return response()->download(storage_path($template->name.' TIMS'.strtotime('now').'.docx'));

    }

}
