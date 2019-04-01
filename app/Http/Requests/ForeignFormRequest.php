<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForeignFormRequest extends FormRequest
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
            'organisedBy' => 'required|max:191',
            'notifiedBy' => 'required|max:191',
            'targetGroup' => 'required|max:191',
            'startDate' => 'required|max:255|date|after_or_equal:today',
            'endDate' => 'required|max:191|date|after_or_equal:startDate',
            'applicationClosingDate' => 'required|max:191|before_or_equal:startDate',
            'applicationClosingTime' => 'required|max:191',
            'programBrochure' => 'image|max:1999',

            $messages = [
                'mimes' => 'Only images are allowed.',
                'programBrochure' => 'Program Brochure is required',
            ],
        ];
    }
}
