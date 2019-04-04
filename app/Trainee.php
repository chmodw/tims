<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ProAI\Versioning\Versionable;
use ProAI\Versioning\SoftDeletes;

class Trainee extends Model
{
    use Versionable, SoftDeletes;
    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var array
     * versioned columns
     */
    public $versioned = [
        'epf_no',
        'title',
        'name_with_initials',
        'full_name',
        'office_email',
        'personal_email',
        'mobile',
        'telephone',
        'birthday',
        'grade',
        'designation_id',
        'section_id',
        'nic',
        'passport_no',
        'passport_issued_on',
        'passport_expire_on',
        'meal_pref',
        'nature_of_employment',
        'date_of_appointment'
    ];

    /**
     * @return \Il
     * luminate\Database\Eloquent\Relations\BelongsTo
     */
    public function designationId(){
        return $this->belongsTo('App\Designation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sectionId(){
        return $this->belongsTo('App\Section');
    }




}
