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
        return $this->belongsTo('App\Employee', 'trainee_id','EPFNo');
    }

    public function program_id()
    {
        return $this->morphTo();
    }
}
