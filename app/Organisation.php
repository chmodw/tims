<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = ['organisation_id','name','created_by','updated_by'];
}
