<?php

namespace App\Http\Controllers;

use App\Program;
use App\Employer;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class ProgramController extends Controller
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

    /**
     * Return programs as jason
     *
     * @param $programType
     * @throws \Exception
     */
    public function get($programType){
        $model = 'App\\'.$programType;

        $programs = $model::select(['program_id','program_title','target_group','application_closing_date_time','start_date','organised_by','venue', 'created_at']);

        return Datatables()->of($programs)
            ->addIndexColumn()
//            ->editColumn('start_date', function ($row) {
//                return date('Y-m-d', strtotime($row->start_date));
//            })
            ->editColumn('program_title', function($row) use ($programType){
                return '<a href="'.url('/programs/'.$programType.'/'.$row->program_id).'">'.$row->program_title.'</a>';
            })
//            ->editColumn('application_closing_date_time', function($row){
//                return date('Y-m-d', strtotime($row->application_closing_date_time));
//            })
            ->toJson();
    }

    public function getTraineesData($programType, $programId)
    {
        $model = Program::where('program_id',$programId)->where('type', $programType);
        $json = Datatables()->of($model)->toJson();
        return $json;
    }

    public function getTrainees( Request $request)
    {

        /**
         * save trainee on the programs database
         */
        $program = new Program();

        $program->trainee_id = $request['userId'];
        $program->program_id = $request['programId'];
        $program->recommendation = $request['recommendation'];
        $program->type = $request['type'];

        /**
         * ADD CREATED BY
         */
//        $postGrad->createdBy = auth()->user()->email;
        $program->save($request->all());

        return back()->with('status', "Trainee Added successfully");

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
    public function show($programType, $programId)
    {

        if ( file_exists(base_path().'/App/'.$programType.'.php')) {

            $model = 'App\\'.$programType;

            $program = $model::where('program_id', $programId)->get();

            return view('programs.'.$programType.'.show')->with(compact('program'));

        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit($programType, $programId)
    {

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

    /**
     * get allocated trainees for a program
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trainee($programType, $programId)
    {

        return $programType;
        /**
         * get trainee data
         */
        //get the trainee list
//
//        $trainee = Program::where('program_id', $programId)->where('type', 'LocalProgram')
//                    ->join('employees');

        Program::Where('program_id', $programId)->where('type', 'LocalProgram')->chunk(10, function($program)
        {
            return $program;
        });



//        $traineeIds = Program::where('program_id', $programId)->where('type', 'LocalProgram')->get('trainee_id', '')->toArray();
//
//        $trainees = [];
//        foreach($traineeIds as $id){
//            $trainee = Employer::where('EmployeeId', $id)->get(['NameWithInitial','DesignationId','DateOfAppointment']);
//            $trainees[] = $trainee;
//        }
//
//        return view('programs.'.$programType.'.trainee')->with('program_id', $programId)->with('program_type', $programType)->with(compact('trainees'));
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
