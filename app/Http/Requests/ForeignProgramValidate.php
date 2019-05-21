<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForeignProgramValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'program_title' => 'required|max:255',
            'program_type' => 'required',
            'organised_by_id' => 'required|max:255',
            'notified_by' => 'required|max:255',
            'notified_on' => 'required|date|before_or_equal:today|before_or_equal:application_closing_date|before_or_equal:start_date',
            'target_group' => 'required|max:255',
            'employment_nature' => 'required|max:255',
            'employee_category' => 'required|max:255',
            'venue' => 'required',
            'currency' => 'required|max:255',
            'program_fee' => 'required|max:255',
            'start_date' => 'required|max:255|date|after_or_equal:today|after_or_equal:application_closing_date',
            'end_date' => 'max:255|date|after_or_equal:start_date',
            'application_closing_date' => 'required|max:255|date|after_or_equal:today|before_or_equal:start_date',
            'application_closing_time' => 'required|max:255',
            'other_cost1' => '',
            'program_brochure' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ];
    }
}
