<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $fillable = [

        'sectionName',
        'createdBy',
        'section_hod',
        'section_contact',
        'section_email'

    ];

    public function trainees(){
        return $this->hasMany(Trainee::class);
    }
}
