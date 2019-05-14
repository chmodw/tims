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
            'type' => 'required',
            'DGMRecommendation' => '',
            'AGMRecommendation' => '',
            'recommendation_radio' => 'required'
        ]);

        $program = new Program();

        if(is_null($program::where('trainee_id', $validatedData['epf_no'])->where('program_id', $validatedData['program_id'])->first())){
            $program->trainee_id = $validatedData['epf_no'];
            $program->program_id = $validatedData['program_id'];
            $program->recommendation = $validatedData[$validatedData['recommendation_radio']];
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

    public function getTrainees($id)
    {
        $trainees = [];

        $programs = Program::where('program_id', $id)->get();

        foreach ($programs as $program)
        {
            $trainee = app('App\Http\Controllers\EmployeeController')->find('EPFNo', $program->trainee_id);

            array_push($trainees,$trainee);
        }

        return $trainees;
    }

    /**
     * @param $class
     * @param $id
     * @return mixed
     * @throws \Exception
     *
     * For datatable
     */
    public function getTrainee($class, $id)
    {
        if (file_exists(base_path() . '/App/' . $class . '.php')) {

            $programs = Program::join('CECB_ERP.dbo.cmn_EmployeeVersion', 'CECB_ERP.dbo.cmn_EmployeeVersion.EPFNo', 'TIMS.dbo.programs.trainee_id')
                ->join('CECB_ERP.dbo.hrm_Designation', 'CECB_ERP.dbo.hrm_Designation.DesignationId', 'CECB_ERP.dbo.cmn_EmployeeVersion.DesignationId')
                ->join('CECB_ERP.dbo.cmn_workspace', 'CECB_ERP.dbo.cmn_workspace.WorkSpaceId', 'CECB_ERP.dbo.cmn_EmployeeVersion.WorkSpaceId')
                ->join('CECB_ERP.dbo.cmn_WorkSpaceType', 'CECB_ERP.dbo.cmn_WorkSpaceType.WorkSpaceTypeId', 'CECB_ERP.dbo.cmn_workspace.WorkSpaceTypeId')
                ->where('TIMS.dbo.programs.type', $class)->where('TIMS.dbo.programs.program_id', $id)
                ->select('cmn_EmployeeVersion.EPFNo', 'CECB_ERP.dbo.cmn_EmployeeVersion.Initial', 'CECB_ERP.dbo.cmn_EmployeeVersion.DateOfAppointment', 'CECB_ERP.dbo.cmn_EmployeeVersion.EmployeeRecruitmentType', 'CECB_ERP.dbo.cmn_EmployeeVersion.Name', 'CECB_ERP.dbo.hrm_Designation.DesignationName', 'CECB_ERP.dbo.cmn_WorkSpaceType.WorkSpaceTypeName', 'TIMS.dbo.programs.program_id', 'TIMS.dbo.programs.type', 'TIMS.dbo.programs.recommendation')
                ->get();


            return Datatables()->of($programs)
                ->addIndexColumn()
                ->addColumn('FullName', function ($row) {
                    return '<a href="' . route('employee.show', $row->EPFNo) . '">'. $row->Initial ." ". ucfirst($row->Name) .'</a>';
                })
                ->addColumn('Experience', function ($row) {
                    return date_diff(
                        date_create(date('Y-m-d', strtotime('today'))),
                        date_create(date('Y-m-d', strtotime($row->DateOfAppointment))))
                        ->format('%Y years and %m months');
                })
                ->addColumn('RemoveForm', function ($row) {
                    return
                        '<form method="POST" action="'. route('trainee.destroy', $row->program_id) .'">'.
                        csrf_field() .
                        '<input name="_method" type="hidden" value="DELETE">'.
                        '<input name="EPFNo" type="hidden" value="'.$row->EPFNo.'">
                            <input name="program_id" type="hidden" value="'. $row->program_id .'">
                            <button  class="btn btn-link" onclick="return confirm(\'Are you sure?\')">
                                <i class="glyphicon glyphicon-minus-sign" style="color: red;"></i>
                            </button>
                         </form>';
                })
                ->toJson();
        }
    }

    public function find(Request $request)
    {
        $trainee = app('App\Http\Controllers\EmployeeController')->find($request->select_option, $request->search_content);

        $trainee = $trainee->toArray();

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

    public function getEmployeeCode(Employee $employee){}
    public function getEPFNo(Employee $employee){}
    public function getTitle(Employee $employee){

    }
    public function getName(Employee $employee){

        if(strpos(strtolower($employee->DesignationName), 'eng') || strpos(strtolower($employee->DesignationName), 'engineer')){
            return 'Eng. '.$employee->Initial.' '. ucwords(strtolower($employee->Name));
        }elseif ($employee->gender == 1){
            return 'Mr. '.$employee->Initial.' '. ucwords(strtolower($employee->Name));
        }else{
            return 'Ms. '.$employee->Initial.' '. ucwords(strtolower($employee->Name));
        }


    }
    public function getFullName(Employee $employee){}
    public function getNIC(Employee $employee){}
    public function getGender(Employee $employee){}
    public function getReligion(Employee $employee){}
    public function getBloodGroup(Employee $employee){}
    public function getDateOfBirth(Employee $employee){}
    public function getBasicSalary(Employee $employee){}
    public function getCivilStatus(Employee $employee){}
    public function getHomeAddress(Employee $employee){}
    public function getContactAddress(Employee $employee){}
    public function getLandphoneNumber(Employee $employee){}
    public function getMobileNumber(Employee $employee){}
    public function getPrivateEmail(Employee $employee){}
    public function getEmployeeRecruitmentType(Employee $employee){}
    public function getJoinedDate(Employee $employee){}
    public function getExperience(Employee $employee){}
    public function getTypeOfContract(Employee $employee){}
    public function getOfficeEmail(Employee $employee){}
    public function getInitialBasicSalary(Employee $employee){}
    public function getOfficeEmail2(Employee $employee){}
    public function getEmergencyContactNumber(Employee $employee){}
    public function getEmergencyContactNumber2(Employee $employee){}
    public function getEmergencyContactAddress(Employee $employee){}
    public function getDateOfRetainment(Employee $employee){}
    public function getInitial(Employee $employee){

    }
    public function getRecommendation(Employee $employee, $program_id)
    {
        /**
         * Needs better mechanism
         */
        return Program::where('program_id', $program_id)->where('trainee_id',$employee->EPFNo)->get('recommendation')->first()['recommendation'];

    }
    public function getDesignation(Employee $employee){
        return $employee->DesignationName;
    }
    public function getWorkSpaceTypeName(Employee $employee){}
    public function getWorkSpaceName(Employee $employee){}
    public function getWorkSpaceCode(Employee $employee){}
    public function getAGMWorkSpaceTypeName(Employee $employee){}
    public function getAGMWorkspaceName(Employee $employee){}
    public function getAGMWorkspaceCode(Employee $employee){}
    public function getDGMWorkSpaceTypeName(Employee $employee){}
    public function getGMWorkspaceName(Employee $employee){}
    public function getDGMWorkSpaceCode(Employee $employee){}
    public function getGrade(Employee $employee){}
}
