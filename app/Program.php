<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

    protected $fillable = ['trainee_id'];


    public function payments(){

        return $this->hasMany(Payment::class);

    }

    public function trainees()
    {
        return $this->belongsTo('App\Employer', 'trainee_id','EmployeeId');
    }

    public function program_id()
    {
        return $this->morphTo();
    }
}
