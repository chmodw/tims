<?php

namespace App\Http\Controllers;

use App\InHouseProgram;
use Illuminate\Http\Request;

class InHouseProgramController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs/InHouseProgram/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = app('App\Http\Controllers\OrganisationController')->index();

        return view('programs/InHouseProgram/create')->with('orgs', $orgs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        {"_token":"oTCiMC0PqYCFHprNXrrHwSdRJ04SG2NmJUbYWDpC","program_type":"LocalProgram","program_title":"new title","target_group":"new target group","employment_nature":["permanent","job contract"],"employee_category":["technical"],"organised_by_id":"new org","venue":"audi","resource_person_1":["Tom","manager","58000"],"resource_person_2":["Jerry","CEO","88997"],"start_date":"2019-04-27","start_time":"12:00","end_time":"15:00","application_closing_date":"2019-04-19","application_closing_time":"00:00","per_person_cost":"5684","registration_cost":"2000","other_costs_1":["drinks","Foods","50000","4000"],"_submit":"reload_page","program_brochure":{}}


        return $request;
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
     * get All the Local programs
     *
     * @return Json
     * @throws \Exception
     */
    public function getInhousePrograms(){

        $programs = InHouseProgram::join('organisations', 'organisations.organisation_id', 'in_house_programs.organised_by_id')
            ->select('in_house_programs.program_id', 'in_house_programs.program_title', 'in_house_programs.target_group', 'in_house_programs.application_closing_date_time','in_house_programs.start_date', 'in_house_programs.venue', 'in_house_programs.created_at','organisations.name')
            ->get();

        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) {
                return '<a href="' . url('/inhouse/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }
}
