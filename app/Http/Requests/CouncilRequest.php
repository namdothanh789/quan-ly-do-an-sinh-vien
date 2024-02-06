<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CouncilRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            //
            'co_title' => 'required | max:225',
            'teacher.*' => ['required'],
            'co_content' => ['required'],
            'co_course_id' => ['required'],
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'co_title.required' => 'Vui lòng nhập vào dữ liệu',
            'co_title.max' => 'Vượt quá số ký tự cho phép',
            'teacher.required' => 'Dữ liệu không được phép để trống.',
            'co_course_id.required' => 'Dữ liệu không được phép để trống.',
            'co_content.required' => 'Dữ liệu không được phép để trống.',
        ];
    }
}