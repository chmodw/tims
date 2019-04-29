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
            'requirements' => 'required|max:255',
            "application_closing_date" => 'required|date',
            "application_closing_time" => 'required|time',
            "start_date" => 'required|date',
            "duration" => 'required|max:10',
            "registration_fees" => 'required|max:100',
            "installments" => 'required',
            'program_brochure' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ];
    }
}
