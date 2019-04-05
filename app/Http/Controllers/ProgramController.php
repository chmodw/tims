<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        "programId":"16d4fb8d8e05b5b8dc16824c270738e8","userId":"06EDA9D6-CC3E-4C3E-94BD-B8A773C54269","type":"LocalProgram"}

        /**
         * REQUEST VALIDATE HERE
         */

        $program = new Program();

        $program->trainee_id = $request['userId'];
        $program->program_id = $request['programId'];
        $program->type = $request['type'];

        /**
         * ADD CREATED BY
         */
//        $postGrad->createdBy = auth()->user()->email;
        $program->save($request->all());

        return back()->with('status', "Trainee Added successfully");
//        return redirect('/programs/postgrad')->with('status', 'Program has been saved successfully');
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
}
