<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{

    protected $fillable = [
        'program_id',
        'name',
        'content',
        'value',
        'created_by',
        'updated_by'
    ];

    public function Payable()
    {
        return $this->morphTo();
    }

    public function getCostContentAttribute()
    {
        if(Helpers::is_serialized($this->attributes['cost_content'])){
            return unserialize($this->attributes['cost_content']);
        }
        return $this->attributes['cost_content'];

    }

}
