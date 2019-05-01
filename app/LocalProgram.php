<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LocalProgram extends Model
{
    protected $fillable = [

    ];

    protected $dates = ['created_at'];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public function organisedById()
    {
        return $this->belongsTo('Organisation\Trainee', 'organisation_id');
    }

    public function program_id()
    {
        return $this->morphMany('App\Program', 'program_id');
    }

    public function organised_by_id()
    {
        return $this->hasOne('App\Organisation', 'organisation_id', 'organised_by_id');
    }


    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }

    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('Y-m-d');
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


}