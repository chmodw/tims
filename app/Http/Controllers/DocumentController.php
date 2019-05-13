<?php

namespace App\Http\Controllers;


use App\ForeignProgram;
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

        $programs =  ForeignProgram::first();

        foreach ($programs as $program){
            var_dump($program);
        }

        return;

        if($request->submit == 'Customize and Generate'){
            return 123;
        }


        $template_name = TemplateManager::find($request->doc_type)->get('file_name')->first()->file_name;

        try {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/templates/'.$template_name));
        }
        catch (exception $e) {
            return $e->getMessage();
        }

        var_dump($templateProcessor->getVariables());

        return;

        echo '<pre>';

        /**
         * New rows
         */
        $numberOfRows = 100;
        $templateProcessor->cloneRow('no', $numberOfRows);





        $templateProcessor->setValue('date', date('d.m.Y', strtotime('today')));
        $templateProcessor->setValue('year', date('Y', strtotime('today ')));






        $templateProcessor->saveAs(storage_path('helloWorld.docx'));


        return response()->download(storage_path('helloWorld.docx'));

    }
}
