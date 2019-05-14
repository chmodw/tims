<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable =[

        'program_id',
        'program_title',
        'trainee_id',
        'trainee_name',
        'payment_Date',
        'payment_amount'

    ];
}
