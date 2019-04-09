<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalProgram extends Model
{
    protected $fillable = [
        'program_id',
        'program_title',
        'organised_by',
        'target_group',
        'start_date',
        'end_date',
        'application_closing_date_time',
        'nature_of_the_appointment',
        'employee_category',
        'venue',
        'course_fee',
        'duration',
        'non_member_fee',
        'member_fee',
        'student_fee',
        'program_brochure',
        'created_by',
        'updated_by'
    ];
}

//    protected $guarded = ['start_time'];

//2S22]: [Microsoft][ODBC Driver 13 for SQL Server][SQL Server]Invalid column name 'program_title'. (SQL: insert into [local_programs] ([program_title], [organised_by], [target_group], [start_date], [start_time], [end_date], [end_time], [venue], [nature_of_the_appointment], [employee_category], [course_fee], [duration], [application_closing_date], [application_closing_time], [non_member_fee], [member_fee], [student_fee], [updated_at], [created_at]) values (kdk, kdmkm, kmd, 2019-05-02, 00:00, 2019-05-03, 00:00, sdkl, permanent, non-tech, 11, 11, 2019-04-13, 00:00, 011, 111, 11, 2019-04-08 14:42:25.701, 2019-04-08 14:42:25.701))
