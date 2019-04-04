<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $guarded = ["id"];

    /**
     * Get Trainees
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trainees()
    {
        return $this->hasMany(TraineeVersion::class);
    }

    public function budget()
    {
        return $this->hasOne(Budget::class);
    }



}
