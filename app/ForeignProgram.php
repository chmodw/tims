<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForeignProgram extends Model
{
    //        array(11) { ["_token"]=> string(40) "K8rgHhWwx7f09eA6QKxQ2uYCU3H2xym5pTvVEa1S" ["program_type"]=> string(22) "ForeignTrainingProgram" ["programTitle"]=> NULL ["organisedBy"]=> NULL ["notifiedBy"]=> NULL ["targetGroup"]=> NULL ["startDate"]=> NULL ["endDate"]=> NULL ["applicationClosingDate"]=> NULL ["applicationClosingTime"]=> NULL ["submitLocalTrainingForm"]=> string(4) "Save" }


    public function getApplicationClosingDateAttribute(){
        return date("Y-m-d", strtotime($this->applicationClosingDateTime));
    }

    public function getStartingDateAttribute(){
        return date("Y-m-d", strtotime($this->startDate));
    }

}
