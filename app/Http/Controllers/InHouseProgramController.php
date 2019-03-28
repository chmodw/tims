<?php

namespace App\Http\Controllers;

use App\Http\Requests\InHouseFormRequest;
use App\InHouseProgram;
use Illuminate\Http\Request;
use App\Helper\Helper;

class InHouseProgramController extends Controller
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
        return view('programs.inhouse');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InHouseFormRequest $request)
    {

        $validated = $request->validated();

        $inhouse = new InHouseProgram();

        $randomProgramId = Helper::uId([$validated['programTitle'],auth()->user()->email,$request->program_type,$validated['startDate']]);

        $inhouse->programId = $randomProgramId;
        $inhouse->title = $validated['programTitle'];
        //save the content as a serialized array
        $inhouse->content = Serialize(explode(', ', $validated['programContent']));
        $inhouse->targetGroup = $validated['targetGroup'];
        $inhouse->organisedBy = $validated['organisedBy'];
        $inhouse->venue = $validated['venue'];
        $inhouse->startDateTime = Helper::jointDateTime($validated['startDate'],$validated['startTime']);
        $inhouse->endDateTime = Helper::jointDateTime($validated['endDate'],$validated['endTime']);
        $inhouse->applicationClosingDateTime = Helper::jointDateTime($validated['applicationClosingDate'], $validated['applicationClosingTime']);
        $inhouse->keyPerson = $validated['keyPerson'];
        $inhouse->keyPersonDesignation = $validated['keyPersonDesignation'];
        $inhouse->registrationCost = $validated['registrationCost'];
        $inhouse->nonRegistrationCost = $validated['nonRegistrationCost'];
        $inhouse->headCost = $validated['headCost'];
        $inhouse->lecturerCost = $validated['lecturerCost'];
        $inhouse->hours = $validated['lecturerCostHours'];
        $inhouse->createdBy = auth()->user()->email;
        $inhouse->save($validated);

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
