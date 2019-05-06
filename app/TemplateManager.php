<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TemplateManager extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'templates_manager';

    public function getProgramTypeAttribute()
    {
        switch ($this->attributes['program_type']) {
            case 'local_program':
            return 'Local Program';
        break;
            case 'foreign_program':
            return 'Foreign Program';
        break;
            case 'inhouse_program':
            return 'In-House Program';
        break;
            case 'postgrad_program':
            return 'Post-Graduation Program';
        break;
            default:
                return 'No Type Found';
        }
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i');
    }

    public function getUpdatedByAttribute()
    {
        if($this->attributes['updated_by'] != null){
            return $this->attributes['updated_by'];
        }else{
            return 'Not Updated';
        }
    }
}
