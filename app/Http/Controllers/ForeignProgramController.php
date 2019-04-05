<?php

namespace App\Http\Controllers;

use App\ForeignProgram;
use App\Http\Requests\ForeignFormRequest;
use App\LocalProgram;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Program;
use App\Trainee;

class ForeignProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = ForeignProgram::paginate(10);

        return view('programs.foreignProgram.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return(view('programs.ForeignProgram.form'));
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
        $foreignProgram->programId = $randomProgramId;
        $foreignProgram->title = $validated['programTitle'];
        $foreignProgram->organisedBy = $validated['organisedBy'];
        $foreignProgram->notifiedBy = $validated['notifiedBy'];
        $foreignProgram->targetGroup = $validated['targetGroup'];
        $foreignProgram->startDate = $validated['startDate'];
        $foreignProgram->endDate = $validated['endDate'];
        $foreignProgram->applicationClosingDateTime = Helper::jointDateTime($validated['applicationClosingDate'], $validated['applicationClosingTime']);
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
        $foreignProgram->brochureUrl = $savedFile;
        $foreignProgram->createdBy = auth()->user()->email;
        /**
         * Save the data on the database
         */
        $foreignProgram->save($validated);
        /**
         * return to the Form
         */
//        return back()->with('success', "Program has been saved successfully");
        return redirect('/programs/foreign')->with('status', 'Program has been saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = ForeignProgram::where('programId', $id)->get();

        //get the trainee list
        $traineeIds = Program::where('program_id', $id)->where('type', 'ForeignProgram')->get('trainee_id')->toArray();

        //get the trainee information
        $trainees = [];
        foreach($traineeIds as $id){
            $trainee = Trainee::where('EmployeeId', $id)->get(['NameWithInitial','DesignationId','DateOfAppointment']);
            $trainees[] = $trainee;
        }

        return view('programs.foreignProgram.show')->with(compact('program'))->with(compact('trainees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editProgram = ForeignProgram::where('programId', $id)->get();
        return(view('programs.ForeignProgram.edit', compact('editProgram')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForeignFormRequest $request, $id)
    {
        $validated = $request->validated();
        $program = ForeignProgram::find($id);

        $program->title = $validated['programTitle'];
        $program->organisedBy = $validated['organisedBy'];
        $program->notifiedBy = $validated['notifiedBy'];
        $program->targetGroup = $validated['targetGroup'];
        $program->startDate = $validated['startDate'];
        $program->endDate = $validated['endDate'];
        $program->applicationClosingDateTime = Helper::jointDateTime($validated['applicationClosingDate'], $validated['applicationClosingTime']);
        // check if a program brochure is present
        if($request->file('programBrochure') != null){
            //get the file ext
            $ext = $request->file('programBrochure')->getClientOriginalExtension();
            //save the file in the storage
            $savedFile = $request->file('programBrochure')->storeAs('public/brochures', $validated['programId'].".".$ext);
            //save the file name in the database
            $program->brochureUrl = $savedFile;
        }

        $program->updatedBy = auth()->user()->email;
        $program->save();

//        return back()->with('status', "Program has been updated successfully");
        return redirect('/programs/foreign')->with('status', 'Program has been updated successfully');
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
