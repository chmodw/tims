<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{

    protected $fillable = ['section_Id','section_name','budget_year','budget_amount'];

    public function getWorkSpaceTypeId(){

        return $this->belongsTo('App\WorkSpaceType','section_Id','WorkSpaceTypeId');
    }


}


