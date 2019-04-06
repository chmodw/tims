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
        if($type = 'LocalProgram'){
            $program = LocalProgram::where('programId', $id)->get();
        }elseif ($type = 'ForeignProgram'){
            $program = ForeignProgram::where('programId', $id)->get();
        }elseif ($type = 'PostGradProgram'){
            $program = PostGradProgram::where('programId', $id)->get();
        }elseif ($type = 'InHouseProgram'){
            $program = InHouseProgram::where('programId', $id)->get();
        }

        //get the trainee list
        $traineeIds = Program::where('program_id', $id)->where('type', $type)->get('trainee_id')->toArray();

        $trainees = [];
        foreach($traineeIds as $id){
            $trainee = Trainee::where('EmployeeId', $id)->get(['FullName','DesignationId','EmployeeRecruitmentType']);

            $designation = Designation::where('DesignationId', $trainee[0]->DesignationId)->get()[0]->DesignationName;
            $trainee[0]['DesignationName'] = $designation;

            $trainees[] = $trainee;
        }
        //        $html = file_get_contents('views/templates/sample.html');;
        $view = \View::make('templates/sample', [
            'program' => $program,
            'trainees' => $trainees,
            'date' => date('d.m.Y'),
            'title' => 'Society of Structural Engineers, Sri lanka - Annual Sessions 2018'
        ]);
        $html = $view->render();

        $pdf = new TCPDF();
//        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output('hello_world.pdf');

//        PDF::reset();
    }
}
