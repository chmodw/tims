<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable =['amount'];



    public  function section(){

        return $this->hasOne('App\Section');
    }
}
