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
        $saved = $postGradProgram->save($validated);

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
}
