<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostGradProgram extends Model
{
    protected $fillable =[
        'id',
        'program_id',
        'title',
        'institute',
        'department',
        'programs',
        'requirements',
        'application_closing_date_time',
        'registration_fees',
        'firstYear_fees',
        'secondYear_fees',
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
