<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Http\Requests\TraineeRequestForm;
use App\Program;
use App\Section;
use App\Employer;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainees/index');
    }

//        return redirect('/shares')->with('success', 'Stock has been added');
//        return back()->with('success', "Program has been saved successfully");

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {

        $trainee = Employer::where('EPFNo', $req->epfNo)->get();
        //get the designation name
        $designation = Designation::where('DesignationId',$trainee[0]->DesignationId)->get()[0]->DesignationName;

        //calculate experiance time
        $d1 = new \DateTime(date('Y-m-d',strtotime($trainee[0]->DateOfAppointment)));
        $d2 = new \DateTime(date('Y-m-d',strtotime('today')));

        $dateDiff = ($d1->diff($d2)->m);

        $trainee[0]['designationName'] = $designation;
        $trainee[0]['experience'] = $dateDiff;


        return back()->with(["trainee" => $trainee]);

    }

    public function showTrainees($programType, $programId){
        return $programId;
    }

    /**
     * return information about the trainees in the programs table
     */
    public function getActiveTrainees(){



    }

}
