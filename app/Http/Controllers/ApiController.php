<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPrograms($programType)
    {

        $model = 'App\\' . $programType;
        $tbl = $model::getTableName();

        $programs = $model::join('organisations', 'organisations.organisation_id', $tbl.'.organised_by_id')
                        ->select($tbl.'.program_id', $tbl.'.program_title', $tbl.'.target_group', $tbl.'.application_closing_date_time',$tbl.'.start_date',$tbl.'.venue',$tbl.'.created_at','organisations.name')
                        ->get();

        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) use ($programType) {
                return '<a href="' . url('/programs/' . $programType . '/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }
}
