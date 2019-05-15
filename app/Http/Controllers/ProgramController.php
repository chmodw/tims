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

            return view('employee.trainee')->with(compact('program'))->with(['program_type' => $class]);

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

    public function getProgram($class, $id){

        if (file_exists(base_path() . '/App/' . $class . '.php')) {

            $model = 'App\\' . $class;
            $table = $model::getTableName();

            return $model::join('organisations', 'organisations.organisation_id', $table.'.organised_by_id')
                        ->where('program_id', $id)
                        ->first();
        }
    }

    public function findMyProgram($id)
    {
        $program = LocalProgram::where('program_id', $id)->first();
        if ($program !== null) {
            return redirect('/local/'.$id);
        }

        $program = PostGradProgram::where('program_id', $id)->first();
        if ($program !== null) {
            return redirect('/postgrad/'.$id);
        }

        $program = ForeignProgram::where('program_id', $id)->first();
        if ($program !== null) {
            return redirect('/foreign/'.$id);
        }

        $program = InHouseProgram::where('program_id', $id)->first();
        if ($program !== null) {
            return redirect('/inhouse/'.$id);
        }
    }

    /**
     * Get recent programs as json
     */
    public function getPrograms(){

        $local = LocalProgram::orderBy('created_at', 'desc')->take(2)->select('program_title', 'program_id')->get()->toArray();
        $post = PostGradProgram::orderBy('created_at', 'desc')->take(2)->select('program_title', 'program_id')->get()->toArray();
        $inhouse = InHouseProgram::orderBy('created_at', 'desc')->take(2)->select('program_title', 'program_id')->get()->toArray();
        $foreign = ForeignProgram::orderBy('created_at', 'desc')->take(2)->select('program_title', 'program_id')->get()->toArray();

        $arr = array_merge($local, $post, $inhouse, $foreign);

        return Datatables()->of($arr)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) {
                return '<a href="' . url('program/findMyProgram/' . $row['program_id']) . '">' . $row['program_title'] . '</a>';
            })
            ->toJson();

    }
}
