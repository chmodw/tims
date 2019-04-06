<?php

namespace App\Http\Controllers;

use App\Designation;
use App\LocalProgram;
use App\ForeignProgram;
use App\PostGradProgram;
use App\InHouseProgram;
use App\Program;
use App\Trainee;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;

class PdfController extends Controller
{
    public function index()
    {

    }

    public function create($id, $type){

        //get Program details
        $program = LocalProgram::where('programId', $id)->get();

        //get the trainee list
        $traineeIds = Program::where('program_id', $id)->where('type', $type)->get('trainee_id')->toArray();

        $trainees = [];
        foreach($traineeIds as $id){

            $trainee = Trainee::where('EmployeeId', $id['trainee_id'])->get(['FullName','DesignationId','EmployeeRecruitmentType']);
            $trainees[] = $trainee;

            $designation = Designation::where('DesignationId', $trainee[0]->DesignationId)->get()[0]->DesignationName;
            $trainee[0]['DesignationName'] = $designation;
        }

        //        $html = file_get_contents('views/templates/sample.html');;
        $view = \View::make('templates/sample', [
            'program' => $program,
            'date' => date('d.m.Y'),
        ])->with(['trainees'=>$trainees]);

        $html = $view->render();

        $pdf = new TCPDF();
//        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output('local.pdf');

//        PDF::reset();
    }
}
