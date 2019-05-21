<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ForeignProgram extends Model
{
    protected $fillable =[
//        'program_id',
//        'title',
//        'organised_by_id',
//        'notified_by',
//        'target_group',
//        'nature_of_the_appointment',
//        'employee_category',
//        'venue',
//        'currency',
//        'course_fee',
//        'start_date',
//        'end_date',
//        'application_closing_date_time',
//        'duration',
//        'brochure_url',
//        'created_by',
//        'updated_by',
    ];

    public function program_id()
    {
        return $this->morphMany('App\Program', 'program_id');
    }

    public function organisation()
    {
        return $this->hasOne('App\Organisation', 'organisation_id', 'organised_by_id');
    }

    public function costs()
    {
        return $this->hasMany('App\Cost', 'program_id', 'program_id');
    }

    public function getOtherCostsAttribute()
    {
        return unserialize($this->attributes['other_costs']);
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i');
    }

    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('Y-m-d');
    }

    public function getNatureOfTheEmploymentAttribute()
    {
        return implode(", ",unserialize($this->attributes['nature_of_the_employment']));
    }

    public function getEmployeeCategoryAttribute()
    {
        $arr = unserialize($this->attributes['employee_category']);
        return implode(", ",$arr);
    }

    public function getApplicationClosingDateTimeAttribute()
    {
        return Carbon::parse($this->attributes['application_closing_date_time'])->format('Y-m-d H:i');
    }

    public function getEmployeeCountAttribute(){
        return 'hello';
    }
}
