<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalProgramValidate extends FormRequest
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
            'target_group' => 'required|max:255',
            'start_date' => 'required|max:255|date|after_or_equal:today',
            'start_time' => 'required|max:255',
            'end_date' => 'max:255|date|after_or_equal:start_date',
            'end_time' => 'max:255',
            'employment_nature' => 'required',
            'employee_category' => 'required|max:255',
            'program_fee' => '',
            'venue' => 'required',
            'duration' => 'required',
            'application_closing_date' => 'required|max:191|before_or_equal:start_date',
            'application_closing_time' => 'required|max:255',
            'non_member_fee' => 'max:100',
            'member_fee' => 'max:100',
            'student_fee' => 'max:100',
            'program_brochure' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ];
    }
}
