<?php

namespace App\Http\Controllers;

use App\Employee;
use function foo\func;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Employee-list');
        $this->middleware('permission:Employee-list', ['only' => ['getEmployee','find']]);
        $this->middleware('permission:Employee-show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee/index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $employee = Employee
            ::join('hrm_Designation', 'hrm_Designation.DesignationId', 'cmn_EmployeeVersion.DesignationId')
            ->join('hrm_Grade','hrm_Grade.GradeId','cmn_EmployeeVersion.GradeId')
            ->join('cmn_workspace','cmn_workspace.WorkSpaceId','cmn_EmployeeVersion.AGMWorkSpaceId')
            ->join('cmn_WorkSpaceType', 'cmn_WorkSpaceType.WorkSpaceTypeId', 'cmn_workspace.WorkSpaceTypeId')
            ->where('cmn_EmployeeVersion.EPFNo', $id)->where('cmn_EmployeeVersion.IsActive', true)
            ->select(
                'cmn_EmployeeVersion.EmployeeCode',
                'cmn_EmployeeVersion.EPFNo',
                'cmn_EmployeeVersion.Title',
                'cmn_EmployeeVersion.NameWithInitial',
                'cmn_EmployeeVersion.FullName',
                'cmn_EmployeeVersion.NIC',
                'cmn_EmployeeVersion.Gender',
                'cmn_EmployeeVersion.Religion',
                'cmn_EmployeeVersion.BloodGroup',
                'cmn_EmployeeVersion.DateOfBirth',
                'cmn_EmployeeVersion.BasicSalary',
                'cmn_EmployeeVersion.CivilStatus',
                'cmn_EmployeeVersion.HomeAddress',
                'cmn_EmployeeVersion.ContactAddress',
                'cmn_EmployeeVersion.LandphoneNumber',
                'cmn_EmployeeVersion.MobileNumber',
                'cmn_EmployeeVersion.PrivateEmail',
                'cmn_EmployeeVersion.NextOfKin',
                'cmn_EmployeeVersion.NextOfKinRelationShip',
                'cmn_EmployeeVersion.EmployeeRecruitmentType',
                'cmn_EmployeeVersion.DateOfAppointment',
                'cmn_EmployeeVersion.TypeOfContract',
                'cmn_EmployeeVersion.DataStatus',
                'cmn_EmployeeVersion.OfficeEmail',
                'cmn_EmployeeVersion.PersonalFileNo',
                'cmn_EmployeeVersion.InitialBasicSalary',
                'cmn_EmployeeVersion.OfficeEmail2',
                'cmn_EmployeeVersion.EmergencyContactNumber',
                'cmn_EmployeeVersion.EmergencyContactNumber2',
                'cmn_EmployeeVersion.EmergencyContactAddress',
                'cmn_EmployeeVersion.Race',
                'cmn_EmployeeVersion.EmpStatus',
                'cmn_EmployeeVersion.Initial',
                'cmn_EmployeeVersion.Name',
                'cmn_EmployeeVersion.ImageUrl',
                'cmn_EmployeeVersion.DateOfExpiry',
                'cmn_EmployeeVersion.IncrementDate',
                'cmn_EmployeeVersion.CreatedDateTime',
                'cmn_EmployeeVersion.UpdatedDateTime',
                'hrm_Grade.*',
                'hrm_Designation.DesignationName',
                'cmn_workspace.WorkSpaceName',
                'cmn_workspace.WorkSpaceCode',
                'cmn_workspace.LocationName',
                'cmn_WorkSpaceType.WorkSpaceTypeName'

            )
            ->first();

        return view('employee.show',['employee' => $employee]);
    }


    /**
     * get All the Local programs
     *
     * @return Json
     * @throws \Exception
     */
    public function getEmployee(){

        $employees = Employee::join('hrm_Designation', 'hrm_Designation.DesignationId', 'cmn_EmployeeVersion.DesignationId')
            ->join('cmn_workspace','cmn_workspace.WorkSpaceId','cmn_EmployeeVersion.WorkSpaceId')
            ->join('cmn_WorkSpaceType', 'cmn_WorkSpaceType.WorkSpaceTypeId', 'cmn_workspace.WorkSpaceTypeId')
            ->where('cmn_EmployeeVersion.IsActive', 1)
            ->select(
                'cmn_EmployeeVersion.FullName',
                'cmn_EmployeeVersion.EPFNo', 
                'cmn_EmployeeVersion.DateOfAppointment',
                'cmn_EmployeeVersion.EmployeeRecruitmentType',
                'cmn_EmployeeVersion.Title',
                'cmn_EmployeeVersion.NIC',
                'cmn_EmployeeVersion.Gender',
                'cmn_EmployeeVersion.NameWithInitial',
                'cmn_EmployeeVersion.DateOfBirth',
                'cmn_EmployeeVersion.PrivateEmail',
                'cmn_EmployeeVersion.OfficeEmail',
                'cmn_EmployeeVersion.LandphoneNumber',
                'cmn_EmployeeVersion.MobileNumber',
                'hrm_Designation.DesignationName',
                'cmn_WorkSpaceType.WorkSpaceTypeName')
            ->get();

        return Datatables()->of($employees)
            ->addIndexColumn()
            ->editColumn('FullName', function ($row) {
                if($row->FullName == ''){
                    return $row->NameWithInitial;
                }
                return ucwords(strtolower($row->FullName));
            })
            ->editColumn('Gender', function ($row) {
                if($row->Gender == 1){
                    return 'Male';
                }elseif($row->Gender == 2){
                    return 'Female';
                }else{
                    return 'Unknown';
                }
            })
            ->editColumn('DateOfAppointment', function ($row) {
                return date('Y-m-d', strtotime($row->DateOfAppointment));
            })
            ->addColumn('Experience', function ($row){
                return date_diff(
                    date_create(date('Y-m-d', strtotime('today'))),
                    date_create(date('Y-m-d', strtotime($row->DateOfAppointment))))
                    ->format('%Y Y & %m M');
            })
            ->addColumn('actions', function ($row){
                return '<a href="' . route('employee.show', $row->EPFNo) . '"><i class="glyphicon glyphicon-eye-open"></i></a>';
            })
            ->editColumn('DateOfBirth', function ($row) {
                return date('Y-m-d', strtotime($row->DateOfBirth));
            })
            ->toJson();
    }

    public function find($select_option, $search_content)
    {
        $trainee = Employee
            ::leftjoin('hrm_Designation', 'hrm_Designation.DesignationId', 'cmn_EmployeeVersion.DesignationId')
            ->leftjoin('cmn_workspace as workspace','workspace.WorkSpaceId','cmn_EmployeeVersion.WorkSpaceId')
            ->leftjoin('cmn_WorkSpaceType as workSpaceType', 'workSpaceType.WorkSpaceTypeId', 'workspace.WorkSpaceTypeId')
            ->leftjoin('cmn_workspace as AGMWorkspace','AGMWorkspace.WorkSpaceId','cmn_EmployeeVersion.AGMWorkSpaceId')
            ->leftjoin('cmn_WorkSpaceType as AGMWorkSpaceType', 'AGMWorkSpaceType.WorkSpaceTypeId', 'AGMWorkspace.WorkSpaceTypeId')
            ->leftjoin('cmn_workspace as DGMWorkspace','DGMWorkspace.WorkSpaceId','cmn_EmployeeVersion.DGMWorkSpaceId')
            ->leftjoin('cmn_WorkSpaceType as DGMWorkSpaceType', 'DGMWorkSpaceType.WorkSpaceTypeId', 'DGMWorkspace.WorkSpaceTypeId')
            ->leftjoin('hrm_Grade','hrm_Grade.GradeId','cmn_EmployeeVersion.GradeId')
            ->where('cmn_EmployeeVersion.'.$select_option,$search_content)->where('cmn_EmployeeVersion.IsActive', 1)
            ->select(
                'cmn_EmployeeVersion.EmployeeCode',
                'cmn_EmployeeVersion.EPFNo',
                'cmn_EmployeeVersion.Title',
                'cmn_EmployeeVersion.NameWithInitial',
                'cmn_EmployeeVersion.FullName',
                'cmn_EmployeeVersion.NIC',
                'cmn_EmployeeVersion.Gender',
                'cmn_EmployeeVersion.Religion',
                'cmn_EmployeeVersion.BloodGroup',
                'cmn_EmployeeVersion.DateOfBirth',
                'cmn_EmployeeVersion.BasicSalary',
                'cmn_EmployeeVersion.CivilStatus',
                'cmn_EmployeeVersion.HomeAddress',
                'cmn_EmployeeVersion.ContactAddress',
                'cmn_EmployeeVersion.LandphoneNumber',
                'cmn_EmployeeVersion.MobileNumber',
                'cmn_EmployeeVersion.PrivateEmail',
                'cmn_EmployeeVersion.EmployeeRecruitmentType',
                'cmn_EmployeeVersion.DateOfAppointment',
                'cmn_EmployeeVersion.TypeOfContract',
                'cmn_EmployeeVersion.OfficeEmail',
                'cmn_EmployeeVersion.InitialBasicSalary',
                'cmn_EmployeeVersion.OfficeEmail2',
                'cmn_EmployeeVersion.EmergencyContactNumber',
                'cmn_EmployeeVersion.EmergencyContactNumber2',
                'cmn_EmployeeVersion.EmergencyContactAddress',
                'cmn_EmployeeVersion.DateOfRetainment',
                'cmn_EmployeeVersion.Initial',
                'cmn_EmployeeVersion.Name',
                'hrm_Designation.DesignationName',
                'workSpaceType.WorkSpaceTypeName',
                'workspace.WorkSpaceName',
                'workspace.WorkSpaceCode',
                'workSpaceType.WorkSpaceTypeName',
                'AGMWorkSpaceType.WorkSpaceTypeName as AGMWorkSpaceTypeName',
                'AGMWorkspace.WorkSpaceName as AGMWorkspaceName',
                'AGMWorkspace.WorkSpaceCode as AGMWorkspaceCode',
                'DGMWorkSpaceType.WorkSpaceTypeName as DGMWorkSpaceTypeName',
                'DGMWorkspace.WorkSpaceName as DGMWorkspaceName',
                'DGMWorkspace.WorkSpaceCode as DGMWorkSpaceCode',
                'hrm_grade.GradeName'
            )

            ->first();

        return $trainee;
    }
}
