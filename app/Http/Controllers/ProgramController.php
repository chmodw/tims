<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
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
    public function index($programType, $id)
    {
        $programs = Program::join('CECB_ERP.dbo.cmn_EmployeeVersion','CECB_ERP.dbo.cmn_EmployeeVersion.EPFNo', 'TIMS.dbo.programs.trainee_id')
            ->join('CECB_ERP.dbo.hrm_Designation', 'CECB_ERP.dbo.hrm_Designation.DesignationId', 'CECB_ERP.dbo.cmn_EmployeeVersion.DesignationId')
            ->join('CECB_ERP.dbo.cmn_workspace','CECB_ERP.dbo.cmn_workspace.WorkSpaceId','CECB_ERP.dbo.cmn_EmployeeVersion.WorkSpaceId')
            ->join('CECB_ERP.dbo.cmn_WorkSpaceType', 'CECB_ERP.dbo.cmn_WorkSpaceType.WorkSpaceTypeId', 'CECB_ERP.dbo.cmn_workspace.WorkSpaceTypeId')
            ->where('TIMS.dbo.programs.type', $programType)->where('TIMS.dbo.programs.program_id', $id)
            ->select('CECB_ERP.dbo.cmn_EmployeeVersion.Initial','CECB_ERP.dbo.cmn_EmployeeVersion.DateOfAppointment', 'CECB_ERP.dbo.cmn_EmployeeVersion.EmployeeRecruitmentType','CECB_ERP.dbo.cmn_EmployeeVersion.Name', 'CECB_ERP.dbo.hrm_Designation.DesignationName', 'CECB_ERP.dbo.cmn_WorkSpaceType.WorkSpaceTypeName', 'TIMS.dbo.programs.type','TIMS.dbo.programs.recommendation')
            ->get();

        return $programs;
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
}
