<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    //Db name
    protected $connection = 'sql_get';
    //Table name
    protected $table = 'dbo.cmn_EmployeeVersion';




    public function  DesignationId(){
        return $this->belongsTo('App\Designation');
    }

    public function getAvailabilityAttribute(){
        return 123;
    }


}
