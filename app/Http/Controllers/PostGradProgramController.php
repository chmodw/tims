<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Helpers;
use App\PostGradProgram;
use App\Http\Requests\PostGradValidate;
use App\Organisation;
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
        /**
         * Check the organisation in the database
         */
        if(is_null(Organisation::where('name', strtolower($validated['organised_by_id']))->first())){
            $orgId = Helpers::u_id([$validated['organised_by_id'], auth()->user()->email, request()->program_type]);
            Organisation::create(['organisation_id' => $orgId, 'name' => strtolower($validated['organised_by_id']), 'created_by' => auth()->user()->email]);
            $postGradProgram->organised_by_id = $orgId;
        }else{
            $orgId = Organisation::where('name', strtolower($validated['organised_by_id']))->get('organisation_id')->first();
            $postGradProgram->organised_by_id = $orgId['organisation_id'];
        }
        $postGradProgram->department = $validated['department'];
        $postGradProgram->target_group = $validated['target_group'];
        $postGradProgram->start_date = $validated['start_date'];
        $postGradProgram->duration = $validated['duration'];
        $postGradProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        if (array_key_exists('is_long_term', $validated)) {
            $postGradProgram->is_long_term = $validated['is_long_term'];
        }
        $postGradProgram->registration_fees = $validated['registration_fees'];
        $postGradProgram->requirements = serialize(Helpers::strings_to_arrays($validated['requirements'], ',')[0]);
        //  check if a program brochure is present
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $program_id . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $postGradProgram->brochure_url = $fileName;
        }

        $postGradProgram->created_by = auth()->user()->email;
        $saved = $postGradProgram->save();

        $installments = Helpers::strings_to_arrays($validated['installments'], '=');

        if($saved){

            foreach ($installments as $installment){

                $installment = explode(',',$installment[0]);

                $costs = new Cost();

                $costs->program_id = $program_id;
                $costs->cost_name = 'installment';
                $costs->cost_content = $installment[0];
                $costs->cost_value = $installment[1];
                $costs->created_by = auth()->user()->email;
                $costs->save();
            }

            return redirect('/postgrad')->with('success', ' The New Post Graduate has been saved successfully');
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
        $program_status = app('App\Http\Controllers\TraineeController')->getTraineeCount($id);

        $costs = Cost::where('program_id', $id)->select('cost_name','cost_content','cost_value')->get();

        $available_documents =  app('App\Http\Controllers\TemplateManagerController')->getTemplates('postgrad_program');

        $program = PostGradProgram::join('organisations', 'organisations.organisation_id', 'post_grad_programs.organised_by_id')
            ->where('post_grad_programs.program_id', $id)
            ->select(
                'post_grad_programs.program_id',
                'post_grad_programs.program_title',
                'post_grad_programs.target_group',
                'post_grad_programs.start_date',
                'post_grad_programs.application_closing_date_time',
                'post_grad_programs.duration',
                'post_grad_programs.requirements',
                'post_grad_programs.registration_fees',
                'post_grad_programs.department',
                'post_grad_programs.brochure_url',
                'post_grad_programs.brochure_url',
                'post_grad_programs.created_at',
                'post_grad_programs.created_by',
                'post_grad_programs.updated_by',
                'organisations.name'
            )
            ->first();

        if(!empty($program)){
            return view('programs.PostGradProgram.show')->with(compact('program'))->with(compact('costs'))->with(compact('program_status'))->with(compact('available_documents'));
        }

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
        $program =  $program = PostGradProgram::join('organisations', 'organisations.organisation_id', 'post_grad_programs.organised_by_id')
            ->where('program_id', $id)
            ->select('post_grad_programs.*', 'organisations.name')
            ->first();

        return view('programs.PostGradProgram.edit')->with(compact('program'))->with(compact('orgs'))->with(compact('costs'));
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

        $program_id = Helpers::u_id([$validated['program_title'],auth()->user()->email,$request->program_type,$validated['start_date']]);

        $postGradProgram->program_title = $validated['program_title'];
        /**
         * Check the organisation in the database
         */
        if(is_null(Organisation::where('name', strtolower($validated['organised_by_id']))->first())){
            $orgId = Helpers::u_id([$validated['organised_by_id'], auth()->user()->email, request()->program_type]);
            Organisation::create(['organisation_id' => $orgId, 'name' => strtolower($validated['organised_by_id']), 'created_by' => auth()->user()->email]);
            $postGradProgram->organised_by_id = $orgId;
        }else{
            $orgId = Organisation::where('name', strtolower($validated['organised_by_id']))->get('organisation_id')->first();
            $postGradProgram->organised_by_id = $orgId['organisation_id'];
        }
        $postGradProgram->department = $validated['department'];
        $postGradProgram->target_group = $validated['target_group'];
        $postGradProgram->start_date = $validated['start_date'];
        $postGradProgram->duration = $validated['duration'];
        $postGradProgram->application_closing_date_time = Helpers::joint_date_time($validated['application_closing_date'], $validated['application_closing_time']);
        $postGradProgram->registration_fees = $validated['registration_fees'];
        $postGradProgram->requirements = serialize(Helpers::strings_to_arrays($validated['requirements'], ',')[0]);
        //  check if a program brochure is present
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $program_id . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $postGradProgram->brochure_url = $fileName;
        }

        $postGradProgram->updated_by = auth()->user()->email;
        $saved = $postGradProgram->save();

        if($saved){

            $installments = Helpers::strings_to_arrays($validated['installments'], '=');
            /**
             * delete previous records before saving updated items
             */
            Cost::where('program_id', $id)->delete();

            foreach ($installments as $installment){

                $installment = explode(',',$installment[0]);

                $costs = new Cost();

                $costs->program_id = $id;
                $costs->cost_name = 'installment';
                $costs->cost_content = $installment[0];
                $costs->cost_value = $installment[1];
                $costs->created_by = auth()->user()->email;

                $costs->save();
            }

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
        $deletedRows = PostGradProgram::where('program_id', $id)->delete();

        if($deletedRows > 0){
            return redirect('/postgrad')->with('success', ' The Post Graduate Program has been successfully Deleted');
        }else{
            return back()->with('failed', "System Could not Delete the Requested Program");
        }
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
