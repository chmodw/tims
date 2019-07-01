<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionPayment extends Model
{
    public function programId()
    {
        return $this->hasMany('App\Program', 'program_id', 'program_id');
    }

}
