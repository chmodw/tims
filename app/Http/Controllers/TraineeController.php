<?php

namespace App\Http\Controllers;

use App\Employee;
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
    public function index($tbl, $id)
    {
        return view('programs/'.$tbl.'/trainee');
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

    public function find(Request $request)
    {
//        $program = $model::join('organisations', 'organisations.organisation_id', $tbl.'.organised_by_id')
//            ->where('program_id', $programId)
//            ->select($tbl.'.program_id', $tbl.'.program_title', $tbl.'.target_group', $tbl.'.start_date', $tbl.'.duration', $tbl.'.application_closing_date_time', $tbl.'.nature_of_the_employment', $tbl.'.employee_category', $tbl.'.venue',$tbl.'.is_long_term', $tbl.'.program_fee', $tbl.'.non_member_fee', $tbl.'.member_fee',$tbl.'.student_fee', $tbl.'.brochure_url', 'organisations.name')
//            ->get();

        $trainee = Employee::join('hrm_Designation', 'hrm_Designation.DesignationId', 'cmn_EmployeeVersion.DesignationId')
                    ->join('cmn_workspace','cmn_workspace.WorkSpaceId','cmn_EmployeeVersion.WorkSpaceId')
                    ->join('cmn_WorkSpaceType', 'cmn_WorkSpaceType.WorkSpaceTypeId', 'cmn_workspace.WorkSpaceTypeId')
                    ->where('cmn_EmployeeVersion.EPFNo', $request->epfNo)->where('cmn_EmployeeVersion.IsActive', 1)
                    ->select('cmn_EmployeeVersion.Initial','cmn_EmployeeVersion.Name', 'hrm_Designation.DesignationName', 'cmn_WorkSpaceType.WorkSpaceTypeName')
                    ->get();
        return $trainee;
    }
}
