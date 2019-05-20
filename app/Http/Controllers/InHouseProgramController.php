<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Helpers;
use App\InHouseProgram;
use App\Organisation;
use Illuminate\Http\Request;
use App\Http\Requests\InHouseProgramValidate;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class InHouseProgramController extends Controller
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
        return view('programs/InHouseProgram/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = app('App\Http\Controllers\OrganisationController')->index();

        return view('programs/InHouseProgram/create')->with('orgs', $orgs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InHouseProgramValidate $request)
    {
        // validate Request
        $validated = $request->validated();

        $inhouse = new InHouseProgram();
        /**
         * Generate a program ID
         */
        $program_id = Helpers::u_id([$validated['agenda1'],auth()->user()->email,$request->program_type,$validated['start_date']]);
        $inhouse->program_id = $program_id;
        $inhouse->program_title =  $this->agendasToArray($request);
        $inhouse->target_group = $validated['target_group'];
        $inhouse->nature_of_the_employment = serialize($validated['employment_nature']);
        $inhouse->employee_category = serialize($validated['employee_category']);
        $inhouse->organised_by_id = Helpers::check_org($validated['organised_by_id'], request()->program_type);
        $inhouse->venue = $validated['venue'];
        $inhouse->start_date = Helpers::joint_date_time($validated['start_date'],$validated['start_time']);
        $inhouse->end_time = $validated['end_time'];
        $inhouse->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $startTime = new \DateTime($validated['start_time']);
        $endTime = new \DateTime($validated['end_time']);
        $inhouse->hours = $startTime->diff($endTime)->format('%h.%i');
        $inhouse->per_person_fee = $validated['per_person_cost'];
        $inhouse->no_show_fee = $validated['no_show_cost'];
        /**
         * check if a program brochure is present
         */
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $program_id . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $inhouse->brochure_url = $fileName;
        }
        $inhouse->created_by = auth()->user()->email;
        $inhouse->resource_person = $this->RPsToArray($request);
        $inhouse->other_costs = $this->costsToArray($request);

        $saved = $inhouse->save();

        if($saved)
        {
            /**
             * if saved the program redirect
             */
            return redirect('/inhouse')->with('success', ' The New In-House Program has been saved successfully');
        }else {
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not save the In-House program. please contact the administrator');
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
        $program = InHouseProgram::where('program_id', $id)->with('organisation')->first();
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
            $available_documents =  app('App\Http\Controllers\TemplateManagerController')->getTemplates('inhouse_program');

            return view('programs.InHouseProgram.show')->with(compact('program'))->with(compact('program_status'))->with(compact('available_documents'));
        }
        /**
         * if the program not found redirect back with error
         */
        return redirect('/inhouse')->with('failed', ' Requested program not found in the database');
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
        $program = InHouseProgram::where('program_id', $id)->with('organisation')->first();

        /**
         * If the program found do other things
         */
        if(!empty($program))
        {
            $orgs = app('App\Http\Controllers\OrganisationController')->index();

            return view('programs.InHouseProgram.edit')->with(compact('program'))->with(compact('orgs'));
        }
        /**
         * if the program not found redirect back with error
         */
        return redirect('/inhouse')->with('failed', ' Requested program not found in the database');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InHouseProgramValidate $request, $id)
    {
        // validate Request
        $validated = $request->validated();

        $inhouse = InHouseProgram::where('program_id', $id)->first();

        /**
         * Generate a program ID
         */
        $inhouse->program_title =  $this->agendasToArray($request);
        $inhouse->target_group = $validated['target_group'];
        $inhouse->nature_of_the_employment = serialize($validated['employment_nature']);
        $inhouse->employee_category = serialize($validated['employee_category']);
        $inhouse->organised_by_id = Helpers::check_org($validated['organised_by_id'], request()->program_type);
        $inhouse->venue = $validated['venue'];
        $inhouse->start_date = Helpers::joint_date_time($validated['start_date'],$validated['start_time']);
        $inhouse->end_time = $validated['end_time'];
        $inhouse->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $startTime = new \DateTime($validated['start_time']);
        $endTime = new \DateTime($validated['end_time']);
        $inhouse->hours = $startTime->diff($endTime)->format('%h.%i');
        $inhouse->per_person_fee = $validated['per_person_cost'];
        $inhouse->no_show_fee = $validated['no_show_cost'];
        /**
         * check if a program brochure is present
         */
        if ($request->file('program_brochure') != null)
        {
            if($inhouse->brochure_url != null)
            {
                if (Storage::exists('public/brochures/'.$inhouse->brochure_url))
                {
                    File::delete('public/brochures/'.$inhouse->brochure_url);
                }
            }
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $id . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $inhouse->brochure_url = $fileName;

        }
        $inhouse->updated = auth()->user()->email;
        $inhouse->resource_person = $this->RPsToArray($request);
        $inhouse->other_costs = $this->costsToArray($request);

        $saved = $inhouse->save();

        if($saved)
        {
            /**
             * if saved the program redirect
             */
            return redirect('/inhouse')->with('success', ' The New In-House Program has been updated successfully');

        }else{
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not save the In-House program. please contact the administrator');
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
        $program = InHouseProgram::where('program_id', $id)->delete();
        $costs = Cost::where('program_id', $id)->delete();

        if($program && $costs){
            return redirect('/inhouse')->with('success', ' The New In-House Program has been Deleted successfully');

        }else{
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not Delete the In-House program. please contact the administrator');
        }
    }

    /**
     * get All the Local programs
     *
     * @return Json
     * @throws \Exception
     */
    public function getInhousePrograms(){

        $programs = InHouseProgram::join('organisations', 'organisations.organisation_id', 'in_house_programs.organised_by_id')
            ->select(
                'in_house_programs.program_id',
                'in_house_programs.program_title',
                'in_house_programs.target_group',
                'in_house_programs.application_closing_date_time',
                'in_house_programs.start_date',
                'in_house_programs.venue',
                'in_house_programs.created_at',
                'organisations.name'
            )
            ->get();

        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) {
                return '<a href="' . url('/inhouse/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }

    private function agendasToArray($array)
    {
        $agendas = array();

        for($i=1;$i<16;$i++)
        {
            if($array->has('agenda'.$i) && $array->has('agenda_from'.$i) && $array->has('agenda_to'.$i))
            {
                array_push($agendas, ['topic' => $array->input('agenda'.$i), 'from' => $array->input('agenda_from'.$i), 'to' => $array->input('agenda_to'.$i)]);
            }else{
                break;
            }
        }

        return serialize($agendas);
    }

    private function RPsToArray($array)
    {
        $rps = array();

        for($i=1;$i<16;$i++)
        {
            if($array->has('resource_person_name'.$i) && $array->has('resource_person_designation'.$i) && $array->has('resource_person_cost'.$i))
            {
                array_push($rps, ['name' => $array->input('resource_person_name'.$i), 'designation' => $array->input('resource_person_designation'.$i), 'cost' => $array->input('resource_person_cost'.$i)]);
            }else{
                break;
            }
        }
        return serialize($rps);
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

    public function getYear(InHouseProgram $program)
    {
        return date('Y', strtotime('today'));
    }

    public function getMonth(InHouseProgram $program)
    {
        return date('m', strtotime('today'));
    }

    public function getToday(InHouseProgram $program)
    {
        return date('d.m.Y', strtotime('today'));
    }

    public function getProgramTitle(InHouseProgram $program)
    {
        return $program->program_title;
    }
    public function getTargetGroup(InHouseProgram $program){}
    public function getOrganisedBy(InHouseProgram $program){}
    public function getNatureOfTheEmployment(InHouseProgram $program){}
    public function getEmployeeCategory(InHouseProgram $program){}
    public function getVenue(InHouseProgram $program){
        return $program->venue;
    }
    public function getStartDate(InHouseProgram $program){
        return date('d.m.Y', strtotime($program->start_date));
    }
    public function getStartTime(InHouseProgram $program){
        return date('H:i', strtotime($program->start_date));
    }
    public function getEndTime(InHouseProgram $program){}
    public function getApplicationClosingDateTime(InHouseProgram $program){}
    public function getNoShowFee(InHouseProgram $program){}
    public function getPerPersonFee(InHouseProgram $program){}
    public function getHours(InHouseProgram $program){}
}
