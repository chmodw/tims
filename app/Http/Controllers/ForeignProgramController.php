<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Document;
use App\ForeignProgram;
use App\Http\Requests\ForeignProgramValidate;
use App\Organisation;
use App\Helpers;
use App\Program;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ForeignProgramController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:program-list');
        $this->middleware('permission:program-create', ['only' => ['create','store']]);
        $this->middleware('permission:program-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:program-delete', ['only' => ['destroy']]);
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

    private function costsToArray($array)
    {
        $costs = array();

        for($i=1;$i<16;$i++)
        {
            if($array->has('cost'.$i) && $array->has('cost_value'.$i))
            {
                array_push($costs, ['name' => $array->input('cost'.$i), 'value' => $array->input('cost_value'.$i)]);
            }else{
                break;
            }
        }
        return serialize($costs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForeignProgramValidate $request)
    {

        $validated = $request->validated();
        $ForeignProgram = new ForeignProgram();

        $randomProgramId = Helpers::u_id([$validated['program_title'],auth()->user()->email,$request->program_type,$validated['start_date']]);

        $ForeignProgram->program_id = $randomProgramId;
        $ForeignProgram->program_title = $validated['program_title'];
        $ForeignProgram->program_type = $validated['program_type'];
        $ForeignProgram->organised_by_id = Helpers::check_org($validated['organised_by_id'], request()->program_type);
        $ForeignProgram->notified_by = $validated['notified_by'];
        $ForeignProgram->notified_on = $validated['notified_on'];
        $ForeignProgram->target_group = $validated['target_group'];
        $ForeignProgram->start_date = $validated['start_date'];
        $ForeignProgram->end_date = $validated['end_date'];
        $ForeignProgram->duration = Helpers::calc_duration($validated['start_date'], $validated['end_date']);
        $ForeignProgram->venue = $validated['venue'];
        $ForeignProgram->currency = $validated['currency'];
        $ForeignProgram->program_fee = $validated['program_fee'];
        $ForeignProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $ForeignProgram->nature_of_the_employment = serialize($validated['employment_nature']);
        $ForeignProgram->employee_category = serialize($validated['employee_category']);
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
        $ForeignProgram->other_costs = $this->costsToArray($request);

        $saved = $ForeignProgram->save($validated);

        if($saved)
        {
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
        /**
         * get the program
         */
        $program = ForeignProgram::where('program_id', $id)->with('costs')->with('organisation')->first();

        /**
         * If the program found do other things
         */
        if(!empty($program))
        {
            /*
             * get program trainee information
             */
            $program_status = app('App\Http\Controllers\TraineeController')->getTraineeCount($id);
            /**
             * Get the available documents for the current program
             */
            $available_documents =  app('App\Http\Controllers\TemplateManagerController')->getTemplates('foreign_program');

            return view('programs.ForeignProgram.show')->with(compact('program'))->with(compact('program_status'))->with(compact('available_documents'));
        }
        /**
         * if the program not found redirect back with error
         */
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

        $program = ForeignProgram::where('program_id', $id)->with('costs')->with('organisation')->first();

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

        $ForeignProgram->program_title = $validated['program_title'];
        $ForeignProgram->program_type = $validated['program_type'];
        $ForeignProgram->organised_by_id = Helpers::check_org($validated['organised_by_id'], request()->program_type);
        $ForeignProgram->notified_by = $validated['notified_by'];
        $ForeignProgram->notified_on = $validated['notified_on'];
        $ForeignProgram->target_group = $validated['target_group'];
        $ForeignProgram->venue = $validated['venue'];
        $ForeignProgram->currency = $validated['currency'];
        $ForeignProgram->program_fee = $validated['program_fee'];
        $ForeignProgram->nature_of_the_employment = serialize($validated['employment_nature']);
        $ForeignProgram->employee_category = serialize($validated['employee_category']);
        $ForeignProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $ForeignProgram->start_date = $validated['start_date'];
        $ForeignProgram->end_date = $validated['end_date'];
        $ForeignProgram->duration = Helpers::calc_duration($validated['start_date'], $validated['end_date']);
        /**
         * check if a program brochure is present
         */
        if ($request->file('program_brochure') != null)
        {
            if($ForeignProgram->brochure_url != null)
            {
                if (Storage::exists('public/brochures/'.$ForeignProgram->brochure_url))
                {
                    File::delete('public/brochures/'.$ForeignProgram->brochure_url);
                }
            }
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $id . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $ForeignProgram->brochure_url = $fileName;

        }
        $ForeignProgram->other_costs = $this->costsToArray($request);
        $ForeignProgram->updated_by = auth()->user()->email;
        $saved = $ForeignProgram->save();

        if($saved)
        {
            return redirect('/foreign')->with('success', ' Requested program successfully updated');
        }else{

            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not save the program. please contact the administrator');

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
    public function getForeignPrograms()
    {

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

    public function getYear(ForeignProgram $program)
    {
        return date('Y', strtotime('today'));
    }

    public function getMonth(ForeignProgram $program)
    {
        return date('m', strtotime('today'));
    }

    public function getToday(ForeignProgram $program)
    {
        return date('d.m.Y', strtotime('today'));
    }

    public function getProgramTitle(ForeignProgram $program)
    {
        return str_replace(' & ', ' and ', $program->program_title);
    }

    public function getNotifiedBy(ForeignProgram $program)
    {
        return str_replace(' & ', ' and ', $program->notified_by);
    }
    public function getNotifiedOn(ForeignProgram $program)
    {
        return date('d.m.Y', strtotime($program->notified_on));
    }

    public function getStartDate(ForeignProgram $program)
    {
        return date('d.m.Y', strtotime($program->start_date));
    }

    public function getProgramYear(ForeignProgram $program)
    {
        return date('Y', strtotime($program->start_date));
    }

    public function getStartDateLong(ForeignProgram $program)
    {
        return date('dS F Y', strtotime($program->start_date));
    }

    public function getStartEndDate(ForeignProgram $program)
    {
        //(14th – 28th April 2018)
        return date('dS F Y', strtotime($program->start_date));
    }

    public function getEndDateLong(ForeignProgram $program)
    {
        return date('dS F Y', strtotime($program->end_date));
    }

    public function getStartDateYear(ForeignProgram $program)
    {
        return date('Y', strtotime('today'));
    }

    public function getRecipients(ForeignProgram $program)
    {
        $recipients = '';
        $recommendations = Program::where('program_id', $program->program_id)->get('recommendation');

        foreach($recommendations as $recommendation)
        {
//            $recipients .= '<w:r><w:t>This is<w:br />'.$recommendation.'</w:t></w:r>';
            $recipients .= ''.$recommendation->recommendation.'<w:br/>';
        }

        return $recipients;
    }

    public function getDuration(ForeignProgram $program)
    {
        return   Helpers::calc_duration($program->start_date, $program->end_date);
    }

    public function getClosingDate(ForeignProgram $program)
    {
        return date('d.m.Y', strtotime($program->application_closing_date_time));
    }

    public function getClosingTime(ForeignProgram $program)
    {
        return date('H:i', strtotime($program->application_closing_date_time));
    }

    public function getOrganisedById(ForeignProgram $program)
    {
        return $program->organisation->name;
    }

    public function getOrganisedBy(ForeignProgram $program)
    {
        return $program->organisation->name;
    }

    public function getTargetGroup(ForeignProgram $program)
    {
        return $program->target_group;
    }

    public function getEmployeeCount(ForeignProgram $program)
    {
        return app('App\Http\Controllers\\TraineeController')->getTraineeCount($program->program_id)['total_count'];
    }

    public function getDocCount(ForeignProgram $program)
    {
        $yearNow = date('Y', strtotime('now'));

        $count = Document::where('program_type', $program->program_type)->where('created_at', 'LIKE', '%'.$yearNow.'%')->get()->count();

        return $count+1;
    }

    public function getVenue(ForeignProgram $program)
    {
        return $program->venue;
    }




//
//    public function getName(ForeignProgram $program)
//    {
//
//    }
//
//    public function getDesignation(ForeignProgram $program)
//    {
//
//    }
//
//    public function getGrade(ForeignProgram $program)
//    {
//
//    }
//
//    public function getJoinedDate(ForeignProgram $program)
//    {
//
//    }
//
//    public function getAppointmentDate(ForeignProgram $program)
//    {
//
//    }
//
//    public function getExperience(ForeignProgram $program)
//    {
//
//    }
//    public function getRecommendation(ForeignProgram $program)
//    {
//
//    }
//
//    public function getForeignTrainingDetails(ForeignProgram $program)
//    {
//
//    }
//
//    public function getForeignTrainingVisitDetails(ForeignProgram $program)
//    {
//
//    }
//
//    public function getFromDate(ForeignProgram $program){
//        //14th – 28th April 2018
//    }
}
