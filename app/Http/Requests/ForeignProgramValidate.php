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
            'organised_by_id' => 'required|max:255',
            'notified_by' => 'required|max:255',
            'target_group' => 'required|max:255',
            'nature_of_the_appointment' => 'required|max:255',
            'employee_category' => 'required|max:255',
            'venue' => 'required|max:255',
            'currency' => 'required|max:255',
            'course_fee' => 'required|max:255',
            'start_date' => 'required|max:255|date|after_or_equal:today',
            'end_date' => 'max:255|date|after_or_equal:start_date',
            'application_closing_date_time' => 'required|max:255',
            'duration' => 'required|max:255',
            'created_by' => 'required|max:255',
            'updated_by' => 'required|max:255',
            'program_brochure' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ];
    }
}
