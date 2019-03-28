<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalProgram extends Model
{

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function getApplicationClosingDateAttribute(){
        return date("Y-m-d", strtotime($this->applicationClosingDateTime));
    }

    public function getStartDateAttribute(){
        return date("Y-m-d", strtotime($this->startDate));
    }

}
