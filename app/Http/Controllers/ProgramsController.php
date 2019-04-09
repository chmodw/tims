<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

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
    public function index($programType)


    {
        if ( file_exists(base_path().'/App/'.$programType.'.php')) {

            return view('programs/'.$programType.'/Index');

        } else {

            return abort(404);

        }

    }

    public function get($programType){
        $model = 'App\\'.$programType;
        return Datatables()->of($model::all())->toJson();
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
                'program_id' => $this->u_id([request()->program_title,auth()->user()->email,request()->program_type,request()->start_date]),
                'created_by' => auth()->user()->email,
            ]);
            /**
             * Add times to dates
             */
            if(array_key_exists('start_date', $data) && array_key_exists('start_time', $data)){
                $data['start_date'] = $this->joint_date_time($data['start_date'], $data['start_time']);
                unset($data['start_time']);
            }
            if(array_key_exists('end_date', $data) && array_key_exists('end_time', $data)){
                $data['end_date'] = $this->joint_date_time($data['end_date'], $data['end_time']);
                unset($data['end_time']);
            }
            if(array_key_exists('end_date', $data) && array_key_exists('application_closing_time', $data)){
                $data['application_closing_date_time'] = $this->joint_date_time($data['application_closing_date'], $data['application_closing_time']);
                unset($data['application_closing_date']);
                unset($data['application_closing_time']);
            }
            if(array_key_exists('program_type', $data)){
                unset($data['program_type']);
            }

        }
        /**
         * Save the data
         */
        $program = $model::create($data);

        if (request()->input('_submit') == 'redirect') {
            return redirect('/programs/'.request()->program_type)->with('status', 'Program has been saved successfully');
        }
        else {
            return back()->with('status', "Program has been saved successfully");
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
        return [
            'program_title' => 'required|max:255',
            'organised_by' => 'required|max:255',
            'notified_by' => 'required|max:255',
            'target_group' => 'required|max:255',
            'nature_of_the_appointment' => 'required|max:255',
            'employee_category' => 'required|max:255',
            'venue' => 'required|max:255',
            'currency' => 'required|max:255',
            'course_fee' => 'required|max:255',
            'start_date' => 'required|max:255|date|after_or_equal:today',
            'end_date' => 'max:255|date|after_or_equal:start_date',
            'application_closing_date_time' => 'required|max:255',
            'duration' => 'required|max:255',
            'program_brochure' => 'image|max:1999',
            'created_by' => 'required|max:255',
            'updated_by' => 'required|max:255',

            $messages = [
                'mimes' => 'Only images are allowed.',
            ],
        ];
    }

    private function PostGradFormValidation(){
        return [];
    }

    private function InHouseFormValidation(){
        return [];
    }

    /**
     * generates a unique id from given data
     */
    private function u_id(Array $params){
        array_push($params, date("M,d,Y h:i:s A"), rand(1,9999999));
        $str = implode($params);
        $str = str_replace(",","",$str);
        $str = str_replace(":","",$str);
        $str = str_replace(" ","",$str);

        return md5($str);
    }

    /**
     * @param $date
     * @param $time
     * @return false|string
     */
    private function joint_date_time($date, $time)
    {
        $timestamp = strtotime($date . " " . $time);

        return date("Y-m-d H:i:s", $timestamp);
    }
}
