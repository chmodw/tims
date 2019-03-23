<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function traineeId(){
        return $this->belongsTo('App\User');
    }

}
