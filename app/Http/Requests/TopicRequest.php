<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
            //
            't_title' => 'required | max:225 | unique:topics,t_title,'.$this->id,
            't_department_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            't_title.required' => 'Vui lòng nhập vào dữ liệu',
            't_title.max' => 'Vượt quá số ký tự cho phép',
            't_title.unique' => 'Dữ liệu không thể trùng lặp',
            't_department_id.required' => 'Dữ liệu không được phép để trống.',
        ];
    }
}
