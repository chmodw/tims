<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    //Db name
    protected $connection = 'sql_get';
    //Table name
    protected $table = 'dbo.cmn_EmployeeVersion';

}
