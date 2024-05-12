<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
        $rules = [
            'name'     => 'required|unique:groups,name,'.$this->id,
            'students.*' => ['required'],
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập vào dữ liệu',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'students.required' => 'Dữ liệu không được phép để trống.',
        ];
    }
}
