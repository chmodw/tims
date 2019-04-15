<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPrograms($programType)
    {

        $model = 'App\\' . $programType;

        $programs = $model::select(['program_id', 'program_title', 'target_group', 'application_closing_date_time', 'start_date', 'organised_by_id', 'venue', 'created_at']);

        return Datatables()->of($programs)
            ->addIndexColumn()
            ->editColumn('program_title', function ($row) use ($programType) {
                return '<a href="' . url('/programs/' . $programType . '/' . $row->program_id) . '">' . $row->program_title . '</a>';
            })
            ->toJson();
    }
}
