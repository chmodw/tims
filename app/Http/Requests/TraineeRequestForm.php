<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TraineeRequestForm extends FormRequest
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

            "title" => 'required|max:191',
            "nameWithInitials" => 'required|max:191',
            "fullName" => 'required|max:191',
            "epfNo" => 'required|max:191',
            "officeEmail" => 'required|max:191',
            "personalEmail" => 'required|max:191',
            "mobile" => 'required|max:191',
            "telephone" => 'required|max:191',
            "birthday" => 'required|max:191',
            "grade" => 'required|max:191',
            "designation" => 'required|max:191',
            "section" => 'required|max:191',
            "nic" => 'required|max:191',
            "passportNo" => 'required|max:191',
            "passportIssuedOn" => 'required|max:191',
            "passportExpireOn" => 'required|max:191',
            "mealPreference" => 'required|max:191',
            "natureOfEmployment" => 'required|max:191',
            "dateOfEmployment" => 'required|max:191',
            "dateOfAppointment" => 'required|max:191',


            $messages = [

            ],
        ];
    }
}
