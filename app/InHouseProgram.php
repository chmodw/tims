<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InHouseProgram extends Model
{

    protected $fillable = [
//        'id',
//        'program_id',
//        'title',
//        'content',
//        'target_group',
//        'organised_by',
//        'venue',
//        'start_date_time',
//        'endDate_time',
//        'application_closing_date_time',
//        'key_person',
//        'key_person_designation',
//        'registration_cost',
//        'non_registration_cost',
//        'head_cost',
//        'lecturer_cost',
//        'hours',
//        'created_by',
//        'updated_by',
    ];

    public function program_id()
    {
        return $this->morphMany('App\Program', 'program_id');
    }

    public function organised_by_id()
    {
        return $this->hasOne('App\Organisation', 'organisation_id', 'organised_by_id');
    }

    public function costs()
    {
        return $this->morphMany('App\Cost', 'Payable');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }

    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('Y-m-d H:i');
    }

    public function getStartTimeAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('H:i');
    }

    public function getNatureOfTheEmploymentAttribute()
    {
        return implode(", ", unserialize($this->attributes['nature_of_the_employment']));
    }

    public function getEmployeeCategoryAttribute()
    {
        return implode(", ", unserialize($this->attributes['employee_category']));
    }

    public function getApplicationClosingDateTimeAttribute()
    {
        return Carbon::parse($this->attributes['application_closing_date_time'])->format('Y-m-d');
    }

    public function getEndTimeAttribute()
    {
        return Carbon::parse($this->attributes['end_time'])->format('H:i');
    }

}
