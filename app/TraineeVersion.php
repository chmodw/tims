<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraineeVersion extends Model
{
    protected $table = "trainee_version";

    protected $primaryKey = "ref_id";

    /**
     * Get programs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function programs()
    {
        return $this->belongsToMany(Program::class, "program_trainee", "trainee_id", "program_id");
    }

    public function payment(){

        return $this->hasMany('App\Payment');

    }
}
