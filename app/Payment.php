<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable =[

        'program_id',
        'trainee_id',
        'trainee_name',
        'payment_date',
        'payment_amount'


    ];

}
