<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\LocalFormRequest;
use App\LocalProgram;
use App\Program;
use App\Trainee;
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
        $programs = LocalProgram::paginate(16);

        return view('programs.localProgram.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.localProgram.form');
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

//        return back()->with('status', "Program has been saved successfully");
        return redirect('/programs/local')->with('status', 'Program has been saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = LocalProgram::where('programId', $id)->get();

        //get the trainee list
        $traineeIds = Program::where('program_id', $id)->where('type', 'LocalProgram')->get('trainee_id')->toArray();

        $trainees = [];
        foreach($traineeIds as $id){
            $trainee = Trainee::where('EmployeeId', $id)->get(['NameWithInitial','DesignationId','DateOfAppointment']);
            $trainees[] = $trainee;
        }

        return view('programs.localProgram.show')->with(compact('program'))->with(compact('trainees'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editProgram = LocalProgram::where('programId', $id)->get();
        return view('programs.localProgram.edit', compact('editProgram'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalFormRequest $request, $id)
    {
        $program = LocalProgram::find($id);

        $validated = $request->validated();

        $program->title = $validated['programTitle'];
        $program->organisedBy = $validated['organisedBy'];
        $program->targetGroup = $validated['targetGroup'];
        $program->startDate = Helper::jointDateTime($validated['startDate'],$validated['startTime']);
        $program->endDate = Helper::jointDateTime($validated['endDate'],$validated['endTime']);
        $program->applicationClosingDateTime = Helper::jointDateTime($validated['applicationClosingDate'], $validated['applicationClosingTime']);
        $program->nonMemberFee = $validated['nonMemberFee'];
        $program->memberFee = $validated['memberFee'];
        $program->studentFee = $validated['studentFee'];
        // check if a program brochure is present
        if($request->file('programBrochure') != null){
            //get the file ext
            $ext = $request->file('programBrochure')->getClientOriginalExtension();
            //save the file in the storage
            $savedFile = $request->file('programBrochure')->storeAs('public/brochures', $request->programId.".".$ext);
            //save the file name in the database
            $program->brochureUrl = $savedFile;
        }

        $program->updatedBy = auth()->user()->email;
        $program->save();

//        return back()->with('status', "Program has been updated successfully");
        return redirect('/programs/local')->with('status', 'Program has been updated successfully');

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
