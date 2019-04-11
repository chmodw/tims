<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InHouseProgram extends Model
{

    protected $fillable = [
        'id',
        'program_id',
        'title',
        'content',
        'target_group',
        'organised_by',
        'venue',
        'start_date_time',
        'endDate_time',
        'application_closing_date_time',
        'key_person',
        'key_person_designation',
        'registration_cost',
        'non_registration_cost',
        'head_cost',
        'lecturer_cost',
        'hours',
        'created_by',
        'updated_by',
    ];

    public function program_id()
    {
        return $this->morphMany('App\Program', 'program_id');
    }
}