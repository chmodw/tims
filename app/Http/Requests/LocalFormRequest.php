<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalFormRequest extends FormRequest
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

//array(14) { ["_token"]=> string(40) "t9uQ12FAkfBcVpOjz2s47rGtX3eXrThwYoJSH6qi" ["programTitle"]=> NULL ["organisedBy"]=> NULL ["targetGroup"]=> NULL ["startDate"]=> NULL ["startTime"]=> NULL ["endDate"]=> NULL ["endTime"]=> NULL ["applicationClosingDate"]=> NULL ["applicationClosingTime"]=> NULL ["nonMemberFee"]=> NULL ["memberFee"]=> NULL ["studentFee"]=> NULL ["submitLocalTrainingForm"]=> string(4) "Save" }
    public function rules()
    {
        return [
            'programTitle' => 'required|max:255',
            'organisedBy' => 'required|max:255',
            'targetGroup' => 'required|max:255',
            'startDate' => 'required|max:255',
            'startTime' => 'required|max:255',
            'endDate' => 'required|max:255',
            'endTime' => 'required|max:255',
            'applicationClosingDate' => 'required|max:255',
            'applicationClosingTime' => 'required|max:255',
            'nonMemberFee' => 'required|max:255',
            'memberFee' => 'required|max:255',
            'studentFee' => 'required|max:255',
            'programBrochure' => 'required|image|max:1999',

            $messages = [
                'mimes' => 'Only images are allowed.',
                'programBrochure' => 'Program Brochure is required',
            ],
        ];
    }
}
