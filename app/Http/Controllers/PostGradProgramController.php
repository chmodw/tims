<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Helpers;
use App\PostGradProgram;
use App\Http\Requests\PostGradValidate;
use App\Organisation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Serializer;

class PostGradProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs/PostGradProgram/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = app('App\Http\Controllers\OrganisationController')->index();

        return view('programs/PostGradProgram/create')->with('orgs', $orgs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostGradValidate $request)
    {
        $validated = $request->validated();
        $postGradProgram = new PostGradProgram();
        $program_id = Helpers::u_id([$validated['program_title'],auth()->user()->email,$request->program_type,$validated['start_date']]);
        $postGradProgram->program_id = $program_id;
        $postGradProgram->program_title = $validated['program_title'];
        $postGradProgram->organised_by_id = Helpers::check_org($validated['organised_by_id'], request()->program_type);
        $postGradProgram->department = $validated['department'];
        $postGradProgram->target_group = $validated['target_group'];
        $postGradProgram->start_date = $validated['start_date'];
        $postGradProgram->duration = $validated['duration'];
        $postGradProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $postGradProgram->registration_fees = $validated['registration_fees'];
        $postGradProgram->requirements = $this->reqToArray($request);
        /**
         * check if a program brochure is present
         */
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $program_id . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $postGradProgram->brochure_url = $fileName;
        }
        $postGradProgram->other_costs = $this->costsToArray($request);
        $postGradProgram->created_by = auth()->user()->email;

        $saved = $postGradProgram->save();

        if($saved){
            return redirect('/postgrad')->with('success', ' The New Post Graduate program has been saved successfully');
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
        $program = PostGradProgram::where('program_id', $id)->with('organisation')->first();
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
            $available_documents =  app('App\Http\Controllers\TemplateManagerController')->getTemplates('postgrad_program');

            return view('programs.PostGradProgram.show')->with(compact('program'))->with(compact('program_status'))->with(compact('available_documents'));
        }
        /**
         * if the program not found redirect back with error
         */
        return redirect('/postgrad')->with('failed', ' Requested program not found in the database');

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
        $program = PostGradProgram::where('program_id', $id)->with('organisation')->first();

        /**
         * If the program found do other things
         */
        if(!empty($program))
        {
            $orgs = app('App\Http\Controllers\OrganisationController')->index();

            return view('programs.PostGradProgram.edit')->with(compact('program'))->with(compact('orgs'));
        }
        /**
         * if the program not found redirect back with error
         */
        return redirect('/postgrad')->with('failed', ' Requested program not found in the database');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostGradValidate $request, $id)
    {
        $validated = $request->validated();
        $postGradProgram = PostGradProgram::where('program_id', $id)->first();

        $postGradProgram->program_title = $validated['program_title'];
        $postGradProgram->organised_by_id = Helpers::check_org($validated['organised_by_id'], request()->program_type);
        $postGradProgram->department = $validated['department'];
        $postGradProgram->target_group = $validated['target_group'];
        $postGradProgram->start_date = $validated['start_date'];
        $postGradProgram->duration = $validated['duration'];
        $postGradProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $postGradProgram->registration_fees = $validated['registration_fees'];
        $postGradProgram->requirements = $this->reqToArray($request);

        /**
         * check if a program brochure is present
         */
        if ($request->file('program_brochure') != null)
        {
            if($postGradProgram->brochure_url != null)
            {
                if (Storage::exists('public/brochures/'.$postGradProgram->brochure_url))
                {
                    File::delete('public/brochures/'.$postGradProgram->brochure_url);
                }
            }
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $id . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $postGradProgram->brochure_url = $fileName;
        }
        $postGradProgram->other_costs = $this->costsToArray($request);
        $postGradProgram->updated_by = auth()->user()->email;

        $saved = $postGradProgram->save();

        if($saved){

            return redirect('/postgrad')->with('success', ' The New Post Graduate has been Updated successfully');
        }else{
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not Updated the program. please contact the administrator');
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

        $filename = PostGradProgram::where('program_id', $id)->first()->brochure_url;

        if (Storage::exists('public/brochures/'.$filename))
        {
            Storage::delete('public/brochures/'.$filename);
        }

        $deletedRows = PostGradProgram::where('program_id', $id)->delete();

        if($deletedRows > 0){
            return redirect('/postgrad')->with('success', ' The Post Graduate Program has been successfully Deleted');
        }else{
            return back()->with('failed', "System Could not Delete the Requested Program");
        }
    }

    private function reqToArray($array)
    {
        $agendas = array();

        for($i=1;$i<16;$i++)
        {
            if($array->has('requirement'.$i))
            {
                array_push($agendas, $array->input('requirement'.$i));
            }else{
                break;
            }
        }

        return serialize($agendas);
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
     * get All the Postgrad programs
     *
     * @return Json
     * @throws \Exception
     */
    public function getPostGradPrograms(){

        $programs = PostGradProgram::join('organisations', 'organisations.organisation_id', 'post_grad_programs.organised_by_id')
            ->select('post_grad_programs.program_id', 'post_grad_programs.program_title', 'post_grad_programs.target_group', 'post_grad_programs.application_closing_date_time','post_grad_programs.start_date', 'post_grad_programs.created_at','organisations.name')
            ->get();

        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) {
                return '<a href="' . url('/postgrad/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }

    public function getYear(PostGradProgram $program){
        return date('Y', strtotime('today'));
    }
    public function getMonth(PostGradProgram $program){
        return date('m', strtotime('today'));
    }
    public function getToday(PostGradProgram $program){
        return date('d.m.Y', strtotime('today'));
    }
    public function getProgramTitle(PostGradProgram $program){
        return $program->program_title;
    }
    public function getProgramTitleShort(PostGradProgram $program){
        return $program->program_title;
    }
    public function getNotifiedBy(PostGradProgram $program){
        return $program->notified_by;
    }
    public function getStartDate(PostGradProgram $program){
        return date('d.m.Y', strtotime($program->start_date));
    }
    public function getStartDateYear(PostGradProgram $program){
        return date('Y', strtotime('today'));
    }
    public function getDuration(PostGradProgram $program){
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
    public function getOrganisedById (PostGradProgram $program){
        return $program->name;
    }
    public function getTargetGroup(PostGradProgram $program){
        return $program->target_group;
    }
    public function getEmployeeCount(PostGradProgram $program){
        return app('App\Http\Controllers\\TraineeController')->getTraineeCount($program->program_id)['total_count'];
    }

    public function getEmploymentNature(PostGradProgram $program){}
    public function getEmployeeCategory(PostGradProgram $program){}
    public function getVenue(PostGradProgram $program){}
    public function getCurrency(PostGradProgram $program){}
    public function getProgramFee(PostGradProgram $program){}
    public function getApplicationClosingDate(PostGradProgram $program){}
    public function getApplicationClosingTime(PostGradProgram $program){}

}
