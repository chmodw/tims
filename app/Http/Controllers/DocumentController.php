<?php

namespace App\Http\Controllers;


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
        return $request->summernoteDemo;
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
        if($request->submit == 'Customize and Generate'){
            return 123;
        }

        try {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('docs/Committee_approval.docx'));
        }
        catch (exception $e) {
            return $e->getMessage();
        }

        $templateProcessor->setValue('date', date('d.m.Y', strtotime('today')));
        $templateProcessor->setValue('year', date('Y', strtotime('today ')));
//        $templateProcessor->setValue('recipient_list', '        Chairman</w:t><w:br/><w:t>General</w:t><w:br/><w:t>Manager</w:t><w:br/><w:t>Corp. AGM (Consultancy)</w:t><w:br/><w:t>Corp. AGM (EPC)
//        ');
        $rl = ['Chairman','General','Manager','Corp. AGM (Consultancy)','Corp. AGM (EPC)'];
        $templateProcessor->cloneRow('recipient_list', 10);

        /**
         * New rows
         */
        $numberOfRows = 100;
        $templateProcessor->cloneRow('name', $numberOfRows);



        $templateProcessor->setValue('program_title', 'Master of Science Degree / Post Graduate Diploma in Construction Law and Dispute Resolution - University of Moratuwa');

        $templateProcessor->saveAs(storage_path('helloWorld.docx'));


        return response()->download(storage_path('helloWorld.docx'));

    }
}
