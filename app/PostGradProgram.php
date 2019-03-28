<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostGradProgram extends Model
{
    public function getApplicationClosingDateAttribute(){
        return date("Y-m-d", strtotime($this->applicationClosingDateTime));
    }

    public function getStartingDateAttribute(){
        return date("Y-m-d", strtotime($this->startDate));
    }

}
