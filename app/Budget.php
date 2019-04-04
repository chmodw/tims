<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $guarded = ["id"];

    public  function section(){

        return $this->belongsTo('App\Section');
    }
}
