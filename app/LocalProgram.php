<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LocalProgram extends Model
{
    protected $fillable = [
        'program_id',
        'program_title',
        'organised_by_id',
        'target_group',
        'start_date',
        'duration',
        'application_closing_date_time',
        'nature_of_the_employment',
        'employee_category',
        'venue',
        'program_fee',
        'non_member_fee',
        'member_fee',
        'student_fee',
        'brochure_url',
        'created_by',
        'updated_by',
//        'created_at'
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

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i');
    }

    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('Y-m-d H:i');
    }

    public function getEndDateAttribute()
    {
        return Carbon::parse($this->attributes['end_date'])->format('Y-m-d H:i');
    }

    public function getApplicationClosingDateTimeAttribute()
    {
        return Carbon::parse($this->attributes['application_closing_date_time'])->format('Y-m-d H:i');
    }

    public function program_id()
    {
        return $this->morphMany('App\Program', 'program_id');
    }

    public function organised_by_id()
    {
        return $this->hasOne('App\Organisation', 'organisation_id', 'organised_by_id');
    }
}