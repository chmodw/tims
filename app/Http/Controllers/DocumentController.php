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

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(11);
        $properties = $phpWord->getDocInfo();
        $properties->setCreator('CECB-TIMS');

        // Adding an empty Section to the document...
        $section = $phpWord->addSection();

        /**
         * Document Header
         */
        $header = $section->addHeader();
        $table = $header->addTable();
        $table->addRow();
        $table->addCell(4500)->addText('CB/TRU/LOC/PG - '.date('Y', strtotime('today')));
        $table->addCell(4500)->addText(date('d.m.Y', strtotime('today')),[], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END));

        /*
         * Recipients
         */
        $section->addText('Chairman');
        $section->addText('General Manager');
        $section->addText('Corp. AGM (Consultancy)');
        $section->addText('Corp. AGM (EPC)');
        $section->addText('');

        /**
         * Heading
         */
        $section->addText('Master of Science Degree / Post Graduate Diploma in Construction Law and Dispute
Resolution - University of Moratuwa',
            [
                'bold' => true,
                'size' => 12
            ],
            [
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH
            ]
        );
        $section->addText('');

        $section->addText('Following officers have applied to follow the M.Sc/PG Diploma Law and Dispute Resolution with the
recommendation of respective AGM.');

        $section->addText('Your consent is sought to select candidates to the captioned programme.');
        $section->addText('');

        $section->addText('Eng. L C K Karunartne');
        $section->addText('Training Manager');




        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('helloWorld.docx');

        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {

        }

        return response()->download(storage_path('helloWorld.docx'));

    }
}
