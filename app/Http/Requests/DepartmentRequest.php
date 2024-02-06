<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'dp_name'     => 'required|unique:departments,dp_name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'dp_name.required'    => 'Dữ liệu không thể để trống',
            'dp_name.unique'      => 'Dữ liệu không được phép trùng lặp',
        ];
    }
}
