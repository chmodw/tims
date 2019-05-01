<?php

namespace App\Http\Controllers;
use App\Http\Requests\LocalProgramValidate;
use App\LocalProgram;
use App\Organisation;
use App\Helpers;

class LocalProgramController extends Controller
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
        return view('programs/LocalProgram/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = app('App\Http\Controllers\OrganisationController')->index();

        return view('programs/LocalProgram/create')->with('orgs', $orgs);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalProgramValidate $request)
    {
        // return $request;
        $validated = $request->validated();
        $localProgram = new LocalProgram();

        $randomProgramId = Helpers::u_id([$validated['program_title'],auth()->user()->email,$request->program_type,$validated['start_date']]);

        $localProgram->program_id = $randomProgramId;
        $localProgram->program_title = $validated['program_title'];
        /**
         * Check the organisation in the database
         */
        if(is_null(Organisation::where('name', strtolower($validated['organised_by_id']))->first())){
            $orgId = Helpers::u_id([$validated['organised_by_id'], auth()->user()->email, request()->program_type]);
            Organisation::create(['organisation_id' => $orgId, 'name' => strtolower($validated['organised_by_id']), 'created_by' => auth()->user()->email]);
            $localProgram->organised_by_id = $orgId;
        }else{
            $orgId = Organisation::where('name', strtolower($validated['organised_by_id']))->get('organisation_id')->first();
            $localProgram->organised_by_id = $orgId['organisation_id'];
        }

        $localProgram->target_group = $validated['target_group'];
        $localProgram->start_date = Helpers::joint_date_time($validated['start_date'],$validated['start_time']);
        $localProgram->duration = $validated['duration'];
        $localProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        if (array_key_exists('is_long_term', $validated)) {
            $localProgram->is_long_term = $validated['is_long_term'];
        }
        $localProgram->nature_of_the_employment = serialize($validated['employment_nature']);
        $localProgram->employee_category = serialize($validated['employee_category']);
        $localProgram->venue = $validated['venue'];
        $localProgram->program_fee = $validated['program_fee'];
        $localProgram->non_member_fee = $validated['non_member_fee'];
        $localProgram->member_fee = $validated['member_fee'];
        $localProgram->student_fee = $validated['student_fee'];

        //  check if a program brochure is present
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $randomProgramId . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $localProgram->brochure_url = $fileName;
        }

        $localProgram->created_by = auth()->user()->email;

        $saved = $localProgram->save($validated);

        if($saved){
            return redirect('/local')->with('success', ' The New Local Program has been saved successfully');
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
        $program = LocalProgram::join('organisations', 'organisations.organisation_id', 'local_programs.organised_by_id')
            ->where('program_id', $id)
            ->select('local_programs.*', 'organisations.name')
            ->first();

        if($program != null){
            return view('programs.LocalProgram.show')->with(compact('program'));
        }

        return redirect('/local')->with('failed', ' Requested program not found in the database');
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

        $program =  $program = LocalProgram::join('organisations', 'organisations.organisation_id', 'local_programs.organised_by_id')
            ->where('program_id', $id)
            ->select('local_programs.program_id', 'local_programs.program_title', 'local_programs.target_group', 'local_programs.start_date', 'local_programs.duration', 'local_programs.application_closing_date_time', 'local_programs.nature_of_the_employment', 'local_programs.employee_category', 'local_programs.venue','local_programs.is_long_term', 'local_programs.program_fee', 'local_programs.non_member_fee', 'local_programs.member_fee','local_programs.student_fee', 'local_programs.brochure_url', 'organisations.name')
            ->get();

        return view('programs.LocalProgram.edit')->with(compact('program'))->with(compact('orgs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalProgramValidate $request, $id)
    {

        $localProgram = LocalProgram::where('program_id', $id)->first();

        $validated = $request->validated();

        $randomProgramId = Helpers::u_id([$validated['program_title'],auth()->user()->email,$request->program_type,$validated['start_date']]);

        $localProgram->program_title = $validated['program_title'];
        /**
         * Check the organisation in the database
         */
        if(is_null(Organisation::where('organisation_id', $validated['organised_by_id'])->first())){
            $orgId = Helpers::u_id([$validated['organised_by_id'], auth()->user()->email, request()->program_type]);
            Organisation::create(['organisation_id' => $orgId, 'name' => $validated['organised_by_id'], 'created_by' => auth()->user()->email]);
            $localProgram->organised_by_id = $orgId;
        }else{
            $orgId = Organisation::where('name', strtolower($validated['organised_by_id']))->get('organisation_id');
            $localProgram->organised_by_id = $orgId;
        }
        $localProgram->target_group = $validated['target_group'];
        $localProgram->start_date = Helpers::joint_date_time($validated['start_date'],$validated['start_time']);
        $localProgram->duration = $validated['duration'];
        $localProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        if (array_key_exists('is_long_term', $validated)) {
            $localProgram->is_long_term = $validated['is_long_term'];
        }
        $localProgram->nature_of_the_employment = serialize($validated['employment_nature']);
        $localProgram->employee_category = serialize($validated['employee_category']);
        $localProgram->venue = $validated['venue'];
        $localProgram->program_fee = $validated['program_fee'];
        $localProgram->non_member_fee = $validated['non_member_fee'];
        $localProgram->member_fee = $validated['member_fee'];
        $localProgram->student_fee = $validated['student_fee'];
        //  check if a program brochure is present
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $randomProgramId . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $localProgram->program_brochure = $fileName;
        }


        $localProgram->updated_by = auth()->user()->email;
        $st = $localProgram->save();

        return redirect('/local')->with('success', ' Requested program successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = LocalProgram::where('program_id', $id)->delete();

        if($deletedRows > 0){
            return redirect('/local')->with('success', ' The New Local Program has been successfully Deleted');
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
    public function getLocalPrograms(){

        $programs = LocalProgram::join('organisations', 'organisations.organisation_id', 'local_programs.organised_by_id')
            ->select('local_programs.program_id', 'local_programs.program_title', 'local_programs.target_group', 'local_programs.application_closing_date_time','local_programs.start_date', 'local_programs.venue', 'local_programs.created_at','organisations.name')
            ->get();

        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) {
                return '<a href="' . url('/local/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }
}
