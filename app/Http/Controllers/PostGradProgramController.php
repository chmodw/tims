<?php

namespace App\Http\Controllers;

use App\PostGradProgram;
use App\Http\Requests\PostGradValidate;

class PostGradProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs/PostGradProgram/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = app('App\Http\Controllers\OrganisationController')->index();

        return view('programs/PostGradProgram/create')->with('orgs', $orgs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostGradValidate $request)
    {
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
     * get All the Postgrad programs
     *
     * @return Json
     * @throws \Exception
     */
    public function getPostGradPrograms(){

        $programs = PostGradProgram::join('organisations', 'organisations.organisation_id', 'post_grad_programs.organised_by_id')
            ->select('post_grad_programs.program_id', 'post_grad_programs.program_title', 'post_grad_programs.target_group', 'post_grad_programs.application_closing_date_time', 'post_grad_programs.created_at','organisations.name')
            ->get();

        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) {
                return '<a href="' . url('/postgrad/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }
}
