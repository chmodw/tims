<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForeignProgram extends Model
{
    protected $fillable =[
        'program_id',
        'title',
        'organised_by',
        'notified_by',
        'target_group',
        'nature_of_the_appointment',
        'employee_category',
        'venue',
        'currency',
        'course_fee',
        'start_date',
        'end_date',
        'application_closing_date_time',
        'duration',
        'brochure_url',
        'created_by',
        'updated_by',
    ];
}
