<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

    public function trainee_id()
    {
        return $this->belongsTo('App\Trainee', 'EmployeeId');
    }

    public function program_id()
    {
        return $this->morphTo();
    }
}
