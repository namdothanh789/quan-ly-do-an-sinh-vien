<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleTeacherRequest extends FormRequest
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
        $rule = [
            'n_title' => ['required'],
            'n_content' =>['required'],
            'teacher_id' =>['required'],
            'n_from_date' =>'required',
            'n_end_date' =>['required'],
        ];

        return $rule;
    }

    public function messages()
    {
        return [
            'n_title.required' => 'Dữ liệu không thể để trống',
            'teacher_id.required' => 'Dữ liệu không thể để trống',
            'n_content.required' => 'Dữ liệu không thể để trống',
            'n_from_date.required' => 'Dữ liệu không thể để trống',
            'n_end_date.required' => 'Dữ liệu không thể để trống',
        ];
    }
}
