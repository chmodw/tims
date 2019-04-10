<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //Db name
    protected $connection = 'sql_get';
    //Table name
    protected $table = 'dbo.hrm_designation';

}
