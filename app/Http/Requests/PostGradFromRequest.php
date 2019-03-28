<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostGradFromRequest extends FormRequest
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
            'institute' => 'required|max:191',
            'department' => 'required',
            'programs' => 'required',
            'requirements' => 'required|max:255',
            'applicationClosingDate' => 'required|max:191|after_or_equal:today',
            'applicationClosingTime' => 'required|max:191',
            'registrationFees' => 'required|max:191',
            'firstYearFees' => 'required|max:191',
            'secondYearFees' => 'required|max:191',
        ];
    }
}
