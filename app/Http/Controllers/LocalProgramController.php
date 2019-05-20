<?php

namespace App\Http\Controllers;
use App\Http\Requests\LocalProgramValidate;
use App\LocalProgram;
use App\Organisation;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $localProgram->organised_by_id = Helpers::check_org($validated['organised_by_id'], request()->program_type);
        $localProgram->target_group = $validated['target_group'];
        $localProgram->start_date = Helpers::joint_date_time($validated['start_date'],$validated['start_time']);
        $localProgram->duration = $validated['duration'];
        $localProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $localProgram->duration_by = $validated['duration_by'];
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
        /**
         * Get the program
         */
        $program = LocalProgram::where('program_id', $id)->with('organisation')->first();

        if(!empty($program))
        {
            /*
             * get program trainee information
             */
            $program_status = app('App\Http\Controllers\TraineeController')->getTraineeCount($id);
            /**
             * Get the available documents for the current program
             */
            $available_documents =  app('App\Http\Controllers\TemplateManagerController')->getTemplates('local_program');

                return view('programs.LocalProgram.show')->with(compact('program'))->with(compact('program_status'))->with(compact('available_documents'));
        }
        /**
         * if the program not found redirect back with error
         */
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
        /**
         * Get the program
         */
        $program = LocalProgram::where('program_id', $id)->with('organisation')->first();
        /**
         * If the program found do other things
         */
        if(!empty($program))
        {
            $orgs = app('App\Http\Controllers\OrganisationController')->index();

            return view('programs.LocalProgram.edit')->with(compact('program'))->with(compact('orgs'));
        }
        /**
         * if the program not found redirect back with error
         */
        return redirect('/local')->with('failed', ' Requested program not found in the database');

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
        $validated = $request->validated();
        $localProgram = LocalProgram::where('program_id', $id)->first();

        $localProgram->program_title = $validated['program_title'];
        $localProgram->organised_by_id = Helpers::check_org($validated['organised_by_id'], request()->program_type);
        $localProgram->target_group = $validated['target_group'];
        $localProgram->start_date = Helpers::joint_date_time($validated['start_date'],$validated['start_time']);
        $localProgram->duration = $validated['duration'];
        $localProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $localProgram->duration_by = $validated['duration_by'];
        $localProgram->nature_of_the_employment = serialize($validated['employment_nature']);
        $localProgram->employee_category = serialize($validated['employee_category']);
        $localProgram->venue = $validated['venue'];
        $localProgram->program_fee = $validated['program_fee'];
        $localProgram->non_member_fee = $validated['non_member_fee'];
        $localProgram->member_fee = $validated['member_fee'];
        $localProgram->student_fee = $validated['student_fee'];
        /**
         * check if a program brochure is present
         */
        if ($request->file('program_brochure') != null)
        {
            if($localProgram->brochure_url != null)
            {
                if (Storage::exists('public/brochures/'.$localProgram->brochure_url))
                {
                    File::delete('public/brochures/'.$localProgram->brochure_url);
                }
            }
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $id . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $localProgram->brochure_url = $fileName;

        }

        $localProgram->updated = auth()->user()->email;

        $saved = $localProgram->save();

        if($saved)
        {
            return redirect('/local')->with('success', ' Requested program successfully updated');
        }else{
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not Update the program. please contact the administrator');
        }

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

    public function getYear(LocalProgram $program){
        return date('Y', strtotime('today'));
    }
    public function getMonth(LocalProgram $program){
        return date('m', strtotime('today'));
    }
    public function getToday(LocalProgram $program){
        return date('d.m.Y', strtotime('today'));
    }
    public function getProgramTitle(LocalProgram $program){
        return $program->program_title;
    }
    public function getNotifiedBy(LocalProgram $program){
        return $program->notified_by;
    }
    public function getStartDate(LocalProgram $program){
        return date('d.m.Y', strtotime($program->start_date));
    }
    public function getStartDateYear(LocalProgram $program){
        return date('Y', strtotime('today'));
    }
    public function getDuration(LocalProgram $program){
        $datetime1 = date_create($program->start_date);
        $datetime2 = date_create($program->end_date);

        $interval = date_diff($datetime1, $datetime2);
        //date diff in months because this is a foreign program
        $duration = $interval->format('%m Months');

        if($duration < 1){
            $duration = $interval->format('%d Days');
        }

        return $duration;
    }
    public function getOrganisedBy (LocalProgram $program){
        return $program->name;
    }
    public function getTargetGroup(LocalProgram $program){
        return $program->target_group;
    }
    public function getEmployeeCount(LocalProgram $program){
        return app('App\Http\Controllers\\TraineeController')->getTraineeCount($program->program_id)['total_count'];
    }
    public function getVenue(LocalProgram $program){
        return $program->venue;
    }
    public function getMemberFee(LocalProgram $program){
        return 'Rs. '.$program->member_fee.'/-';
    }
    public function getNonMemberFee(LocalProgram $program){
        return 'Rs. '.$program->non_member_fee.'/-';
    }
    public function getStudentFee(LocalProgram $program){
        return 'Rs. '.$program->student_fee.'/-';
    }

    public function getProgramId(LocalProgram $program){}
    public function getApplicationClosingDate(LocalProgram $program){}
    public function getApplicationClosingTime(LocalProgram $program){}
    public function getRmployeeCategory(LocalProgram $program){}
    public function getIsLongTerm(LocalProgram $program){}
    public function getProgramFee(LocalProgram $program){}
    public function getBrochureUrl(LocalProgram $program){}
    public function getCreatedBy(LocalProgram $program){}
    public function getUpdatedBy(LocalProgram $program){}
    public function getCreatedAt(LocalProgram $program){}
    public function getUpdatedAt(LocalProgram $program){}
}
