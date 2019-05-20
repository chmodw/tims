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

    public function organisation()
    {
        return $this->hasOne('App\Organisation', 'organisation_id', 'organised_by_id');
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
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
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i');
    }

    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('Y-m-d H:i');
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
        return Carbon::parse($this->attributes['application_closing_date_time'])->format('Y-m-d H:i');
    }

    public function getUpdatedByAttribute()
    {
        if($this->attributes['updated_by'] != null){
            return $this->attributes['updated_by'];
        }else{
            return 'Not Updated';
        }
    }


}