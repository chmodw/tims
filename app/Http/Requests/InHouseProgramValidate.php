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
            'agenda1' => 'required',
            'agenda_from1' => 'required',
            'agenda_to1' => 'required',
            'target_group' => 'required',
            'employment_nature' => 'required',
            'employee_category' => 'required',
            'organised_by_id' => 'required',
            'venue' => 'required',
            'resource_person_name1' => 'required',
            'resource_person_designation1' => 'required',
            'resource_person_cost1' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'start_date' => 'required|max:255|date|after_or_equal:application_closing_date|date',
            'end_date' => 'max:255|date|after_or_equal:start_date',
            'application_closing_date' => 'required|max:255|date|before_or_equal:start_date',
            'application_closing_time' => 'required|max:255',
            'per_person_cost' => '',
            'no_show_cost' => '',
            'cost1' => '',
            'program_brochure' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ];
    }
}
