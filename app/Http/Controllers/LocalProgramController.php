<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\LocalFormRequest;
use App\LocalProgram;
use Illuminate\Http\Request;

class LocalProgramController extends Controller
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
        return view('programs.local');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalFormRequest $request)
    {

        $validated = $request->validated();

        $localProgram = new LocalProgram();

        $randomProgramId = Helper::uId([$validated['programTitle'],auth()->user()->email,$request->program_type,$validated['startDate']]);

        $localProgram->programId = $randomProgramId;
        $localProgram->title = $validated['programTitle'];
        $localProgram->organisedBy = $validated['organisedBy'];
        $localProgram->targetGroup = $validated['targetGroup'];
        $localProgram->startDate = Helper::jointDateTime($validated['startDate'],$validated['startTime']);
        $localProgram->endDate = Helper::jointDateTime($validated['endDate'],$validated['endTime']);
        $localProgram->applicationClosingDateTime = Helper::jointDateTime($validated['applicationClosingDate'], $validated['applicationClosingTime']);
        $localProgram->nonMemberFee = $validated['nonMemberFee'];
        $localProgram->memberFee = $validated['memberFee'];
        $localProgram->studentFee = $validated['studentFee'];
        // check if a program brochure is present
        if($request->file('programBrochure') != null){
            //get the file ext
            $ext = $request->file('programBrochure')->getClientOriginalExtension();
            //save the file in the storage
            $savedFile = $request->file('programBrochure')->storeAs('public/brochures', $randomProgramId.".".$ext);
        }else{
            $savedFile = 'Null';
        }
        //save the file name in the database
        $localProgram->brochureUrl = $savedFile;
        $localProgram->createdBy = auth()->user()->email;
        $localProgram->save($validated);

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
