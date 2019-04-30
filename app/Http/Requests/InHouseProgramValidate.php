<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InHouseProgramValidate extends FormRequest
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
            'program_title' => 'required',
            'target_group' => 'required',
            'employment_nature' => 'required',
            'employee_category' => 'required',
            'organised_by_id' => 'required',
            'venue' => 'required',
            'resource_person' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'application_closing_date' => 'required',
            'application_closing_time' => 'required',
            'per_person_cost' => '',
            'no_show_cost' => '',
            'other_costs' => '',
            'program_brochure' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ];
    }
}