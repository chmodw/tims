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
    public function index($programType, $id)
    {
        return Program::where('type', $programType)->where('program_id', $id)->get();
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
        $validatedData = $request->validate([
            'program_id' => 'required|max:255',
            'epf_no' => 'required|max:20',
            'recommendation' => 'required',
            'type' => 'required'
        ]);

        $program = new Program();

        if(is_null(Program::where('trainee_id', $validatedData['epf_no'])->where('program_id', $validatedData['program_id'])->first())){
            $program->trainee_id = $validatedData['epf_no'];
            $program->program_id = $validatedData['program_id'];
            $program->recommendation = $validatedData['recommendation'];
            $program->type = $validatedData['type'];

            $saved = $program->save($validatedData);

            if($saved){
                return redirect()->back()->with('success', ' Employee Added successfully');
            }else{
                return redirect()->back()->with('failed', ' System Could not save the program. please contact the administrator');
            }
        }else{
            return redirect()->back()->with('failed', ' Employee is added Already');
        }

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
