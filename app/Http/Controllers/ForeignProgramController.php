<?php

namespace App\Http\Controllers;

use App\ForeignProgram;
use App\Http\Requests\ForeignFormRequest;
use Illuminate\Http\Request;
use App\Helper\Helper;

class ForeignProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return(view('programs.foreign'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForeignFormRequest $request)
    {
        $validated = $request->validated();

        $foreignProgram = new ForeignProgram();
        //Generate a program id
        $randomProgramId = Helper::uId([$validated['programTitle'],auth()->user()->email,$request->program_type,$validated['startDate']]);
        $foreignProgram->title = $validated['programTitle'];
        $foreignProgram->organisedBy = $validated['organisedBy'];
        $foreignProgram->notifiedBy = $validated['notifiedBy'];
        $foreignProgram->targetGroup = $validated['targetGroup'];
        $foreignProgram->startDate = $validated['startDate'];
        $foreignProgram->endDate = $validated['endDate'];
        $foreignProgram->applicationClosingDateTime = $validated['applicationClosingDateTime'];
        //get the file ext
        $ext = $request->file('programBrochure')->getClientOriginalExtension();
        //save the file in the storage
        $savedFile = $request->file('programBrochure')->storeAs('public/brochures', $randomProgramId.".".$ext);
        //save the file name in the database
        $foreignProgram->brochureUrl = $savedFile;
        $foreignProgram->createdBy = auth()->user()->email;
        /**
         * Save the data on the database
         */
        $foreignProgram->save();
        /**
         * return to the Form
         */
        return back()->with('success', "Program has been saved successfully");
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
