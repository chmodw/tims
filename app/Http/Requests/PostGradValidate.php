<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostGradValidate extends FormRequest
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
            "program_title" => 'required|max:255',
            "organised_by_id" => 'required|max:100',
            "department" => 'required|max:255',
            "target_group" => 'required|max:255',
            'requirement1' => 'required|max:255',
            'start_date' => 'required|max:255|date|after_or_equal:today|after_or_equal:application_closing_date',
            'application_closing_date' => 'required|max:255|date|after_or_equal:today|before_or_equal:start_date',
            'application_closing_time' => 'required|max:255',
            "duration" => 'required|max:10',
            "registration_fees" => 'required|max:100',
            "cost1" => '',
            'program_brochure' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ];
    }
}
