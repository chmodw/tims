<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Html\Builder;
use App\LocalProgram;
use App\Http\Requests\ProgramFormValidation;

class ProgramsController extends Controller
{

    /**
     * This controller handles all the four types of programs
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, $programType)
    {
        if ( file_exists(base_path().'/App/'.$programType.'.php')) {

            $model = 'App\\'.$programType;

            $programs = $model::paginate(20);

            return view('programs/'.$programType.'/Index');

        } else {

            return abort(404);

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($programType)
    {

        if ( file_exists(base_path().'/App/'.$programType.'.php')) {

            return view('programs/'.$programType.'/create');

        } else {
            return abort(404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ( file_exists(base_path().'/App/'.$request->program_type.'.php')) {

            if($request->program_type == 'LocalProgram'){
                $this->validate(request(), $this->LocalFormValidation());
            }elseif ($request->program_type == 'InHouseProgram'){
                $this->validate(request(), $this->InHouseFormValidation());
            }elseif ($request->program_type == 'PostGradProgram'){
                $this->validate(request(), $this->PostGradFormValidation());
            }elseif ($request->program_type == 'ForeignProgram'){
                $this->validate(request(), $this->ForeignFormValidation());
            }

            $model = 'App\\'.$request->program_type;

            $data = array_merge(request()->all(), [
                'program_id' => u_id([request()->program_title,auth()->user()->email,request()->program_type,request()->start_date]),
                'created_by' => auth()->user()->email,
            ]);
            /**
             * Add times to dates
             */
            if(array_key_exists('start_date', $data) && array_key_exists('start_time', $data)){
                $data['start_date'] = joint_date_time($data['start_date'], $data['start_time']);
                unset($data['start_time']);
            }
            if(array_key_exists('end_date', $data) && array_key_exists('end_time', $data)){
                $data['end_date'] = joint_date_time($data['end_date'], $data['end_time']);
                unset($data['end_time']);
            }
            if(array_key_exists('end_date', $data) && array_key_exists('application_closing_time', $data)){
                $data['application_closing_date_time'] = joint_date_time($data['application_closing_date'], $data['application_closing_time']);
                unset($data['application_closing_date']);
                unset($data['application_closing_time']);
            }
            if(array_key_exists('program_type', $data)){
                unset($data['program_type']);
            }

//            return $data;
            /**
             * Save the data
             */
            $program = $model::create($data);

            /**
             * Save the activity
             */
            activity('Created '.$request->program_type.': ' . $program->program_title, $data, $program, 'Created By: '.auth()->user()->email);
            /**
             * show the message
             */
            flash(['success', 'Program Saved!']);
            /**
             * redirect
             */
            if (request()->input('_submit') == 'redirect') {
                return response()->json(['redirect' => session()->pull('programs.intended', route('programs', 'LocalProgram'))]);
            }
            else {
                return response()->json(['reload_page' => true]);
            }

        } else {

            flash(['success', 'Invalid Date!']);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        //
    }


    private function LocalFormValidation(){
        return [
            'program_title' => 'required|max:255',
            'organised_by' => 'required|max:255',
            'target_group' => 'required|max:255',
            'start_date' => 'required|max:255|date|after_or_equal:today',
            'start_time' => 'required|max:255',
            'end_date' => 'max:255|date|after_or_equal:start_date',
            'end_time' => 'max:255',
            'nature_of_the_appointment' => 'required',
            'employee_category' => 'required',
            'venue' => 'required',
            'course_fee' => '',
            'duration' => '',
            'application_closing_date' => 'required|max:191|before_or_equal:start_date',
            'application_closing_time' => 'required|max:255',
            'non_member_fee' => 'max:255',
            'member_fee' => 'max:255',
            'student_fee' => 'max:255',
            'program_brochure' => 'image|max:1999',

            $messages = [
                'mimes' => 'Only images are allowed.',
            ],
        ];
    }

    private function ForeignFormValidation(){
        return [];
    }

    private function PostGradFormValidation(){
        return [];
    }

    private function InHouseFormValidation(){
        return [];
    }
}
