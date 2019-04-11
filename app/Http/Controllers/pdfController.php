<?php

namespace App\Http\Controllers;

use App\Designation;
use App\LocalProgram;
use App\Program;
use App\Employer;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;

class PdfController extends Controller
{
    public function index()
    {

    }

    public function create($type, $programId){

        //get Program details
        $program = LocalProgram::where('program_id', $programId)->get();
//        return $program;
        //get the trainee list
        $traineeIds = Program::where('program_id', $programId)->where('type', $type)->get('trainee_id')->toArray();

        $trainees = array();
        foreach($traineeIds as $id){

            $trainee = Employer::where('EmployeeId', $id['trainee_id'])->get(['NameWithInitial','DesignationId','EmployeeRecruitmentType']);


            $designation = Designation::where('DesignationId', $trainee[0]->DesignationId)->get()[0]->DesignationName;

            $trainees[] = [ 'data' => $trainee,'recommendation' => Program::where('trainee_id', $id)->where('program_id', $programId)->get('recommendation'), 'DesignationName' => $designation];

//            $trainee[0]['recommendation'] = Program::where('trainee_id', $id)->where('program_id', $programId)->get('recommendation');
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
