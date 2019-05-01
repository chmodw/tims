<?php

namespace App\Http\Controllers;

use App\ForeignProgram;
use App\Http\Requests\ForeignProgramValidate;
use App\Organisation;
use App\Helpers;

class ForeignProgramController extends Controller
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
        // return $request;
        $validated = $request->validated();
        $ForeignProgram = new ForeignProgram();

        $randomProgramId = Helpers::u_id([$validated['program_title'],auth()->user()->email,$request->program_type,$validated['start_date']]);

        $ForeignProgram->program_id = $randomProgramId;
        $ForeignProgram->program_title = $validated['program_title'];
        /**
         * Check the organisation in the database
         */
        if(is_null(Organisation::where('organisation_id', $validated['organised_by_id'])->first())){
            $orgId = Helpers::u_id([$validated['organised_by_id'], auth()->user()->email, request()->program_type]);
            Organisation::create(['organisation_id' => $orgId, 'name' => $validated['organised_by_id'], 'created_by' => auth()->user()->email]);
            $ForeignProgram->organised_by_id = $orgId;
        }else{
            $orgId = Organisation::where('name', strtolower($validated['organised_by_id']))->get('organisation_id')->first();
            $ForeignProgram->organised_by_id = $orgId['organisation_id'];
        }

        $ForeignProgram->notified_by = $validated['notified_by'];

        $ForeignProgram->target_group = $validated['target_group'];
        $ForeignProgram->start_date = $validated['start_date'];
        $ForeignProgram->end_date = $validated['end_date'];
        $ForeignProgram->duration = $validated['duration'];

        $ForeignProgram->venue = $validated['venue'];
        $ForeignProgram->currency = $validated['currency'];
        $ForeignProgram->program_fee = $validated['program_fee'];

        $ForeignProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $ForeignProgram->nature_of_the_employment = serialize($validated['employment_nature']);
        $ForeignProgram->employee_category = serialize($validated['employee_category']);
//        $ForeignProgram->end_date =
        //  check if a program brochure is present
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $randomProgramId . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $ForeignProgram->brochure_url = $fileName;
        }

        $ForeignProgram->created_by = auth()->user()->email;

        $saved = $ForeignProgram->save($validated);

        if($saved){
            return redirect('/foreign')->with('success', ' The New Local Program has been saved successfully');
        }else{
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not save the program. please contact the administrator');
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
        $program = ForeignProgram::join('organisations', 'organisations.organisation_id', 'foreign_programs.organised_by_id')
            ->where('program_id', $id)
            ->select('foreign_programs.*', 'organisations.name')
            ->first();

        if($program != null){
            return view('programs.ForeignProgram.show')->with(compact('program'));
        }

        return redirect('/foreign')->with('failed', ' Requested program not found in the database');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orgs = app('App\Http\Controllers\OrganisationController')->index();

        $program = ForeignProgram::join('organisations', 'organisations.organisation_id', 'foreign_programs.organised_by_id')
            ->where('program_id', $id)
            ->select('foreign_programs.*', 'organisations.name')
            ->get();

        return view('programs.ForeignProgram.edit')->with(compact('program'))->with(compact('orgs'));
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
        $ForeignProgram = ForeignProgram::where('program_id', $id)->first();

        $validated = $request->validated();

        $randomProgramId = Helpers::u_id([$validated['program_title'],auth()->user()->email,$request->program_type,$validated['start_date']]);

        $ForeignProgram->program_title = $validated['program_title'];
        /**
         * Check the organisation in the database
         */
        if(is_null(Organisation::where('name', $validated['organised_by_id'])->first())){
            $orgId = Helpers::u_id([$validated['organised_by_id'], auth()->user()->email, request()->program_type]);
            Organisation::create(['organisation_id' => $orgId, 'name' => $validated['organised_by_id'], 'created_by' => auth()->user()->email]);
            $ForeignProgram->organised_by_id = $orgId;
        }else{
            $orgId = Organisation::where('name', strtolower($validated['organised_by_id']))->get('organisation_id')->first();
            $ForeignProgram->organised_by_id = $orgId['organisation_id'];
        }
        $ForeignProgram->notified_by = $validated['notified_by'];
        $ForeignProgram->target_group = $validated['target_group'];
        $ForeignProgram->venue = $validated['venue'];
        $ForeignProgram->currency = $validated['currency'];
        $ForeignProgram->program_fee = $validated['program_fee'];
        $ForeignProgram->nature_of_the_employment = serialize($validated['employment_nature']);
        $ForeignProgram->employee_category = serialize($validated['employee_category']);
        $ForeignProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $ForeignProgram->start_date = $validated['start_date'];
        $ForeignProgram->end_date = $validated['end_date'];
        $ForeignProgram->duration = $validated['duration'];
        //  check if a program brochure is present
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $randomProgramId . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $ForeignProgram->brochure_url = $fileName;
        }

        $ForeignProgram->updated_by = auth()->user()->email;
        $st = $ForeignProgram->save();

        return redirect('/foreign')->with('success', ' Requested program successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = ForeignProgram::where('program_id', $id)->delete();

        if($deletedRows > 0){
            return redirect('/foreign')->with('success', ' The New Local Program has been successfully Deleted');
        }else{
            return back()->with('failed', "System Could not Delete the Requested Program");
        }
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
                return '<a href="' . url('/foreign/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }
}
