<?php

namespace App\Http\Controllers;

use App\ForeignProgram;
use App\Http\Requests\ForeignProgramValidate;

class ForeignProgramController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['get']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs/ForeignProgram/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = app('App\Http\Controllers\OrganisationController')->index();

        return view('programs/ForeignProgram/create')->with('orgs', $orgs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForeignProgramValidate $request)
    {
        //
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
    public function update(ForeignProgramValidate $request, $id)
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
    public function getForeignPrograms(){

        $programs = ForeignProgram::join('organisations', 'organisations.organisation_id', 'foreign_programs.organised_by_id')
            ->select('foreign_programs.program_id', 'foreign_programs.program_title', 'foreign_programs.target_group', 'foreign_programs.application_closing_date_time','foreign_programs.start_date', 'foreign_programs.venue', 'foreign_programs.created_at','organisations.name')
            ->get();

        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) {
                return '<a href="' . url('/local/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }
}
