<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Http\Requests\TraineeRequestForm;
use App\Section;
use App\Trainee;
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

        $trainee = Trainee::where('EPFNo', $req->epfNo)->get();
        //get the designation name
        $designation = Designation::where('DesignationId',$trainee[0]->DesignationId)->get()[0]->DesignationName;

        $trainee[0]['designationName'] = $designation;

        return back()->with(["trainee" => $trainee]);

    }

}
