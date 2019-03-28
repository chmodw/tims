<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InHouseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(\Auth::user())
        {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'programTitle' => 'required|max:191',
            'programContent' => 'required|max:255',
            'targetGroup' => 'required|max:191',
            'organisedBy' => 'required|max:191',
            'venue' => 'required|max:191',
            'startDate' => 'required|max:20|date|after_or_equal:today',
            'startTime' => 'required|max:10',
            'endDate' => 'required|max:20|date|after_or_equal:startDate',
            'endTime' => 'required|max:10',
            'applicationClosingDate' => 'required|max:191|before_or_equal:startDate|after_or_equal:today',
            'applicationClosingTime' => 'required|max:255',
            'keyPerson' => 'required|max:191',
            'keyPersonDesignation' => 'required|max:191',
            'registrationCost' => 'required|max:191',
            'nonRegistrationCost' => 'required|max:191',
            'headCost' => 'required|max:191',
            'lecturerCost' => 'required|max:191',
            'lecturerCostHours' => 'required|max:191'

            //        array(19) { ["_token"]=> string(40) "NRhYogxrvg2sCcPVMO4O0pYRBx4JDnlfQrLKrAED" ["programTitle"]=> NULL ["programContent"]=> string(1) """ ["targetGroup"]=> NULL ["organizedBy"]=> NULL ["venue"]=> NULL ["startDate"]=> NULL ["startTime"]=> NULL ["endDate"]=> NULL ["applicationClosingDate"]=> NULL ["applicationClosingTime"]=> NULL ["keyPerson"]=> NULL ["keyPersonDesignation"]=> NULL ["registrationCost"]=> NULL ["nonRegistrationCost"]=> NULL ["headCost"]=> NULL ["lecturerCost"]=> NULL ["lecturerCostHours"]=> NULL ["submitLocalTrainingForm"]=> string(4) "Save" }



        ];
    }
}
