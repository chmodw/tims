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

    public function program_id()
    {
        return $this->morphMany('App\Program', 'program_id');
    }
}