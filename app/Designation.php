<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    public function trainees(){
        return $this->hasMany(Trainee::class);
    }
}
