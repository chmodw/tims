<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForeignProgram extends Model
{
    protected $fillable =[
        'program_id',
        'title',
        'organised_by_id',
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

    public function program_id()
    {
        return $this->morphMany('App\Program', 'program_id');
    }

    public function organised_by_id()
    {
        return $this->hasOne('App\Organisation', 'organisation_id', 'organised_by_id');
    }
}
