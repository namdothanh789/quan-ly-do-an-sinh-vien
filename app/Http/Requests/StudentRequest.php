<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StudentRequest extends FormRequest
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
        $validate = [
            'name'  => 'required|max:191',
            'code'  => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email,'.$this->id,
            'phone'  => 'required',
            'gender'  => 'required',
            'department_id'  => 'required',
            'course_id'  => 'required',
            'images'  => 'nullable|image|mimes:jpeg,jpg,png',
        ];
        if ($request->submit !== 'update') {
            $validate['password'] = 'required | max:191 ';
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập vào dữ liệu',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'code.required' => 'Vui lòng nhập vào dữ liệu',
            'email.required' => 'Vui lòng nhập vào dữ liệu',
            'email.unique' => 'Dữ liệu không thể trùng lặp',
            'email.max' => 'Vượt quá số ký tự cho phép',
            'email.email' => 'Dữ liệu định dạng không đúng.',
            'password.required' => 'Dữ liệu không được phép để trống.',
            'phone.required' => 'Dữ liệu không được phép để trống.',
            'gender.required' => 'Dữ liệu không được phép để trống.',
            'position_id.required' => 'Dữ liệu không được phép để trống.',
            'department_id.required' => 'Dữ liệu không được phép để trống.',
            'course_id.required' => 'Dữ liệu không được phép để trống.',
            'images.image'               => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes'               => 'Vui lòng nhập đúng định dạng file ảnh',
        ];
    }
}
