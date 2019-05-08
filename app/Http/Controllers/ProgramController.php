<?php

namespace App\Http\Controllers;

use App\ForeignProgram;
use App\InHouseProgram;
use App\LocalProgram;
use App\PostGradProgram;
use App\Program;
use Illuminate\Http\Request;

class  ProgramController extends Controller
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

            $programs = Program::join('CECB_ERP.dbo.cmn_EmployeeVersion','CECB_ERP.dbo.cmn_EmployeeVersion.EPFNo', 'TIMS.dbo.programs.trainee_id')
                ->join('CECB_ERP.dbo.hrm_Designation', 'CECB_ERP.dbo.hrm_Designation.DesignationId', 'CECB_ERP.dbo.cmn_EmployeeVersion.DesignationId')
                ->join('CECB_ERP.dbo.cmn_workspace','CECB_ERP.dbo.cmn_workspace.WorkSpaceId','CECB_ERP.dbo.cmn_EmployeeVersion.WorkSpaceId')
                ->join('CECB_ERP.dbo.cmn_WorkSpaceType', 'CECB_ERP.dbo.cmn_WorkSpaceType.WorkSpaceTypeId', 'CECB_ERP.dbo.cmn_workspace.WorkSpaceTypeId')
                ->where('TIMS.dbo.programs.type', $class)->where('TIMS.dbo.programs.program_id', $id)
                ->select('cmn_EmployeeVersion.EPFNo','CECB_ERP.dbo.cmn_EmployeeVersion.Initial','CECB_ERP.dbo.cmn_EmployeeVersion.DateOfAppointment', 'CECB_ERP.dbo.cmn_EmployeeVersion.EmployeeRecruitmentType','CECB_ERP.dbo.cmn_EmployeeVersion.Name', 'CECB_ERP.dbo.hrm_Designation.DesignationName', 'CECB_ERP.dbo.cmn_WorkSpaceType.WorkSpaceTypeName', 'TIMS.dbo.programs.program_id','TIMS.dbo.programs.type','TIMS.dbo.programs.recommendation')
                ->get();

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

        /**
         * Get the program IDs
         */
        $program_ids = Program::where('trainee_id', $id)->get('program_id');

        $Localprograms = LocalProgram::whereIn('program_id', $program_ids)->select('program_id','program_title','start_date')->get();
        foreach ($Localprograms as $Localprogram) {
            $Localprogram->program_type = 'Local Program';
            $Localprogram->program_url = 'local/'.$Localprogram->program_id;
        }

        $ForeignPrograms = ForeignProgram::whereIn('program_id', $program_ids)->select('program_id','program_title','start_date')->get();
        foreach ($ForeignPrograms as $ForeignProgram) {
            $ForeignProgram->program_type = 'Foreign Program';
            $ForeignProgram->program_url = 'foreign/'.$ForeignProgram->program_id;
        }

        $InHousePrograms = InHouseProgram::whereIn('program_id', $program_ids)->select('program_id','program_title','start_date')->get();
        foreach ($InHousePrograms as $InHouseProgram) {
            $InHouseProgram->program_type = 'InHouse Program';
            $InHouseProgram->program_url = 'inhouse/'.$InHouseProgram->program_id;
        }

        $PostGradPrograms = PostGradProgram::whereIn('program_id', $program_ids)->select('program_id','program_title','start_date')->get();
        foreach ($PostGradPrograms as $PostGradProgram) {
            $PostGradProgram->program_type = 'Post Graduation Program';
            $PostGradProgram->program_url = 'postgrad/'.$PostGradProgram->program_id;
        }

        $programs = array_merge($Localprograms->toArray(), $PostGradPrograms->toArray(), $ForeignPrograms->toArray(), $InHousePrograms->toArray());


        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) {
                return '<a href="' . url($row['program_url']).'">' . $row['program_title'] . '</a>';
            })
            ->editColumn('start_date', function ($row) {
                return date('Y-m-d', strtotime($row['start_date']));
            })
            ->toJson();
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
