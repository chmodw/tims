<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Helpers;
use App\InHouseProgram;
use App\Organisation;
use Illuminate\Http\Request;
use App\Http\Requests\InHouseProgramValidate;

class InHouseProgramController extends Controller
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
        $program_id = Helpers::u_id([$validated['program_title'],auth()->user()->email,$request->program_type,$validated['start_date']]);

        $inhouse->program_id = $program_id;
        $inhouse->program_title = $validated['program_title'];
        $inhouse->target_group = $validated['target_group'];
        $inhouse->nature_of_the_employment = serialize($validated['employment_nature']);
        $inhouse->employee_category = serialize($validated['employee_category']);
        /**
         * Check the organisation in the database
         */
        if(is_null(Organisation::where('name', strtolower($validated['organised_by_id']))->first())){
            $orgId = Helpers::u_id([$validated['organised_by_id'], auth()->user()->email, request()->program_type]);
            Organisation::create(['organisation_id' => $orgId, 'name' => strtolower($validated['organised_by_id']), 'created_by' => auth()->user()->email]);
            $inhouse->organised_by_id = $orgId;
        }else{
            $orgId = Organisation::where('name', strtolower($validated['organised_by_id']))->get('organisation_id')->first();
            $inhouse->organised_by_id = $orgId['organisation_id'];
        }
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
        /**
         * save resource persons in the cost table
         */
        $resource_persons = Helpers::strings_to_arrays($validated['resource_person'], ',');

        $other_costs = Helpers::strings_to_arrays($validated['other_costs'], '=');

        $saved = $inhouse->save();

        if($saved){
            /**
             * if the program successfully saved on the database, Save the costs
             */
            foreach ($resource_persons as $resource_person){

                $costs = new Cost();

                $costs->program_id = $program_id;
                $costs->cost_name = 'resource person';
                $costs->cost_content = serialize([$resource_person[0],$resource_person[1]]);
                $costs->cost_value = $resource_person[2];
                $costs->created_by = auth()->user()->email;
                $costs->save();
            }

            foreach ($other_costs as $other_cost){

                $other_cost = explode(',',$other_cost[0]);

                $costs = new Cost();

                $costs->program_id = $program_id;
                $costs->cost_name = 'other cost';
                $costs->cost_content = $other_cost[0];
                $costs->cost_value = $other_cost[1];
                $costs->created_by = auth()->user()->email;
                $costs->save();

            }

            return redirect('/inhouse')->with('success', ' The New In-House Program has been saved successfully');

        }else{
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
        $program_status = app('App\Http\Controllers\TraineeController')->getTraineeCount($id);

        $costs = Cost::where('program_id', $id)->select('cost_name','cost_content','cost_value')->get();

        $available_documents =  app('App\Http\Controllers\TemplateManagerController')->getTemplates('inhouse_program');

        $program = InHouseProgram::join('organisations', 'organisations.organisation_id', 'in_house_programs.organised_by_id')
        ->where('in_house_programs.program_id', $id)
        ->select(
            'in_house_programs.program_id',
            'in_house_programs.program_title',
            'in_house_programs.target_group',
            'in_house_programs.nature_of_the_employment',
            'in_house_programs.employee_category',
            'in_house_programs.venue',
            'in_house_programs.start_date',
            'in_house_programs.end_time',
            'in_house_programs.application_closing_date_time',
            'in_house_programs.hours',
            'in_house_programs.no_show_fee',
            'in_house_programs.per_person_fee',
            'in_house_programs.brochure_url',
            'in_house_programs.created_at',
            'in_house_programs.created_by',
            'in_house_programs.updated_by',
            'in_house_programs.updated_at',
            'organisations.name'
        )
        ->first();

        if(!empty($program)){
            return view('programs.InHouseProgram.show')->with(compact('program'))->with(compact('costs'))->with(compact('program_status'))->with(compact('available_documents'));
        }

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
         * Get all the organisations
         */
        $orgs = app('App\Http\Controllers\OrganisationController')->index();
        /**
         * get costs
         */
        $costs = Cost::where('program_id', $id)->select('cost_name','cost_content','cost_value')->get();
        /**
         * Get program
         */
        $program =  $program = InHouseProgram::join('organisations', 'organisations.organisation_id', 'in_house_programs.organised_by_id')
            ->where('program_id', $id)
            ->select('in_house_programs.*', 'organisations.name')
            ->first();

        return view('programs.InHouseProgram.edit')->with(compact('program'))->with(compact('orgs'))->with(compact('costs'));
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
        $program_id = Helpers::u_id([$validated['program_title'],auth()->user()->email,$request->program_type,$validated['start_date']]);

        $inhouse->program_id = $program_id;
        $inhouse->program_title = $validated['program_title'];
        $inhouse->target_group = $validated['target_group'];
        $inhouse->nature_of_the_employment = serialize($validated['employment_nature']);
        $inhouse->employee_category = serialize($validated['employee_category']);
        /**
         * Check the organisation in the database
         */
        if(is_null(Organisation::where('name', strtolower($validated['organised_by_id']))->first())){
            $orgId = Helpers::u_id([$validated['organised_by_id'], auth()->user()->email, request()->program_type]);
            Organisation::create(['organisation_id' => $orgId, 'name' => strtolower($validated['organised_by_id']), 'created_by' => auth()->user()->email]);
            $inhouse->organised_by_id = $orgId;
        }else{
            $orgId = Organisation::where('name', strtolower($validated['organised_by_id']))->get('organisation_id')->first();
            $inhouse->organised_by_id = $orgId['organisation_id'];
        }
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

        $inhouse->updated_by = auth()->user()->email;

        $saved = $inhouse->save();

        if($saved){
            /**
             * delete previous records before saving updated items
             */
            Cost::where('program_id', $id)->delete();
            /**
             * save resource persons in the cost table
             */
            $resource_persons = Helpers::strings_to_arrays($validated['resource_person'], ',');

            $other_costs = Helpers::strings_to_arrays($validated['other_costs'], '=');
            /**
             * if the program successfully saved on the database, Save the costs
             */
            foreach ($resource_persons as $resource_person){

                $costs = new Cost();

                $costs->program_id = $id;
                $costs->cost_name = 'resource person';
                $costs->cost_content = serialize([$resource_person[0],$resource_person[1]]);
                $costs->cost_value = $resource_person[2];
                $costs->created_by = auth()->user()->email;
                $costs->save();
            }

            foreach ($other_costs as $other_cost){

                $other_cost = explode(',',$other_cost[0]);

                $costs = new Cost();

                $costs->program_id = $id;
                $costs->cost_name = 'other cost';
                $costs->cost_content = $other_cost[0];
                $costs->cost_value = $other_cost[1];
                $costs->created_by = auth()->user()->email;
                $costs->save();

            }

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
