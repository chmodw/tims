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
        if (file_exists(base_path() . '/App/' . $class . '.php')) {

            $model = 'App\\' . $class;

            $tbl = $model::getTableName();

            $program = $model::where('program_id', $id)->select($tbl.'.program_id', $tbl.'.program_title')->first();

            $programs = app('App\Http\Controllers\ProgramController')->index($class, $id);

            return view('employee.trainee')->with(compact('program'))->with(['program_type' => $class])->with(compact('programs'));

        } else {
            return abort(404);
        }
        
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

    public function find(Request $request)
    {


        $trainee = Employee::join('hrm_Designation', 'hrm_Designation.DesignationId', 'cmn_EmployeeVersion.DesignationId')
//                    ->join('cmn_workspace','cmn_workspace.WorkSpaceId','cmn_EmployeeVersion.WorkSpaceId')
                    ->join('cmn_workspace','cmn_workspace.WorkSpaceId','cmn_EmployeeVersion.AGMWorkSpaceId')
//                    ->join('cmn_workspace','cmn_workspace.WorkSpaceId','cmn_EmployeeVersion.DGMWorkSpaceId')
                    ->join('cmn_WorkSpaceType', 'cmn_WorkSpaceType.WorkSpaceTypeId', 'cmn_workspace.WorkSpaceTypeId')
                    ->where('cmn_EmployeeVersion.'.$request->select_option,$request->search_content)->where('cmn_EmployeeVersion.IsActive', 1)
                    ->select('cmn_EmployeeVersion.Initial','cmn_EmployeeVersion.FullName','cmn_EmployeeVersion.EPFNo','cmn_EmployeeVersion.DateOfAppointment', 'cmn_EmployeeVersion.EmployeeRecruitmentType','cmn_EmployeeVersion.Name', 'hrm_Designation.DesignationName', 'cmn_WorkSpaceType.WorkSpaceTypeName','cmn_WorkSpace.WorkSpaceName','cmn_WorkSpace.WorkSpaceCode')
                    ->first();

        if(isset($trainee)){
            return redirect()->back()->with(compact('trainee'));
        }

        return redirect()->back()->with(['failed'=>' No Record Found']);
    }
}
