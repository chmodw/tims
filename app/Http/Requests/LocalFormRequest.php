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
    public function rules()
    {
        return [
            'programTitle' => 'required|max:255',
            'organisedBy' => 'required|max:255',
            'targetGroup' => 'required|max:255',
            'startDate' => 'required|max:255|date|after_or_equal:today',
            'startTime' => 'required|max:255',
            'endDate' => 'required|max:255|date|after_or_equal:startDate',
            'endTime' => 'required|max:255',
            'applicationClosingDate' => 'required|max:191|before_or_equal:startDate',
            'applicationClosingTime' => 'required|max:255',
            'nonMemberFee' => 'required|max:255',
            'memberFee' => 'required|max:255',
            'studentFee' => 'required|max:255',
            'programBrochure' => 'image|max:1999',


            $messages = [
                'mimes' => 'Only images are allowed.',
                'programBrochure' => 'Program Brochure is required',
            ],
        ];
    }
}
