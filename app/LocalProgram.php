<?php

namespace App;

use Carbon\Carbon;
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

    protected $dates = ['created_at'];

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

    public function organised_by()
    {
        return $this->belongsTo('App\Organisation', 'id');
    }
}