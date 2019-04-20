<?php

namespace App\Http\Controllers;

use App\Employee;
use function foo\func;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getLocalPrograms']]);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            ->editColumn('DateOfBirth', function ($row) {
                return date('Y-m-d', strtotime($row->DateOfBirth));
            })
            ->toJson();
    }
}
