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
        $costs = new Cost();
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

        //  check if a program brochure is present
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $program_id . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $inhouse->brochure_url = $fileName;
        }

        if (array_key_exists('resource_person_2', $validated)) {
            return $validated;
        }else{
            return 'no';
        }

        $program_id->created_by = auth()->user()->email;

        $saved = $inhouse->save($validated);

        if($saved){
            /**
             * if the program successfully saved on the database, Save the costs
             */
            $i=1;
            while (false){

                $resource_person_1 = new Cost([
                    'program_id' => $program_id,
                    'name' => 'resource person',
                    'content' => 'Foo bar.',
                    'value' => 'Foo bar.',
                    'created_by' => auth()->user()->email
                ]);
            }


            //Find the video to insert into a tag
            InHouseProgram::where('program_id', $program_id)->costs()->save($cost);


        }else{
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not save the In-House program. please contact the administrator');
        }




        //        {"_token":"Gl9jB121bZ4HZ5IzHFJd260kfvTiX7mb7GFm86VQ","program_type":"LocalProgram","program_title":null,"target_group":"skjdnfsfjk","employment_nature":["permanent","job contract"],"employee_category":["technical","non-technical"],"organised_by_id":"dfkjnsdfjnk","venue":"kjnfgdkjnfg","resource_person_1":["kjnfgkjdng","kjnf","88"],"resource_person_2":["dfkjndsf","dkjfgdjgkn","99"],"start_date":"2019-04-25","start_time":"00:00","end_time":"00:00","application_closing_date":"0001-01-20","application_closing_time":"00:00","per_person_cost":"00","registration_cost":"848","other_costs_1":["8485","558"],"other_costs_2":["88","002"],"_submit":"reload_page"}

        return $program_id;
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

    /**
     * get All the Local programs
     *
     * @return Json
     * @throws \Exception
     */
    public function getInhousePrograms(){

        $programs = InHouseProgram::join('organisations', 'organisations.organisation_id', 'in_house_programs.organised_by_id')
            ->select('in_house_programs.program_id', 'in_house_programs.program_title', 'in_house_programs.target_group', 'in_house_programs.application_closing_date_time','in_house_programs.start_date', 'in_house_programs.venue', 'in_house_programs.created_at','organisations.name')
            ->get();

        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) {
                return '<a href="' . url('/inhouse/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }
}
