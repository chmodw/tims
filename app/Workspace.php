<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    //Db name
    protected $connection = 'sql_get';
    //Table name
    protected $table = 'dbo.cmn_WorkSpace';


    public function WorkSpaceTypeId()
    {
        return $this->belongsTo('App\WorkSpaceType');
    }



}
