<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Program;
use Illuminate\Http\Request;

class TraineeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
//        , ['except' => ['getInhousePrograms']]
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($class, $id)
    {

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($programId)
    {
        return $programId;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'program_id' => 'required|max:255',
            'epf_no' => 'required|max:20',
            'recommendation' => 'required',
            'type' => 'required'
        ]);

        $program = new Program();

        if(is_null($program::where('trainee_id', $validatedData['epf_no'])->where('program_id', $validatedData['program_id'])->first())){
            $program->trainee_id = $validatedData['epf_no'];
            $program->program_id = $validatedData['program_id'];
            $program->recommendation = $validatedData['recommendation'];
            $program->type = $validatedData['type'];
            $program->created_by = auth()->user()->email;

            $saved = $program->save();

            if($saved){
                return redirect()->back()->with('success', ' Employee Added successfully');
            }else{
                return redirect()->back()->with('failed', ' System Could not save the program. please contact the administrator');
            }
        }else{
            return redirect()->back()->with('failed', ' Employee is added Already');
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
    public function destroy(Request $request)
    {
        $deleted = Program
            ::where('trainee_id', $request->EPFNo)
            ->where('program_id', $request->program_id)
            ->delete();

        if($deleted == true){
            return redirect()->back();
        }else{
            return redirect()->back()->with(['failed'=>' No Record Found']);
        }
    }

    public function find(Request $request)
    {
        $trainee = app('App\Http\Controllers\EmployeeController')->find($request);

        if(isset($trainee)){
            return redirect()->back()->with(compact('trainee'));
        }

        return redirect()->back()->with(['failed'=>' No Record Found']);
    }

    public function getTraineeCount($program_id)
    {
        $trainees = Program::where('program_id', $program_id)->get();
        $trainee_status['total_count'] = $trainees->count();

        $trainee_status['count_by_unit'] = [];

        foreach ($trainees as $trainee){

            if(array_key_exists($trainee->recommendation, $trainee_status['count_by_unit'])){
                $trainee_status['count_by_unit'][$trainee->recommendation] = $trainee_status['count_by_unit'][$trainee->recommendation] += 1;
            }else{
                $trainee_status['count_by_unit'][$trainee->recommendation] = 1;
            }

        }

        return $trainee_status;

    }
}
