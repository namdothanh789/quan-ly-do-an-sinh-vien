<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CourseRequest extends FormRequest
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
            'c_name'     => 'required|unique:courses,c_name,'.$this->id,
            'c_start_time' => 'required',
            'c_end_time' => 'required'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'c_name.required'       => 'Dữ liệu không được phép để trống',
            'c_name.unique'         => 'Dữ liệu đã bị trùng',
            'c_start_time.required' => 'Dữ liệu không được phép để trống',
            'c_end_time.required'   => 'Dữ liệu không được phép để trống',
            'c_start_time.after'    => 'Ngày bắt đầu phải lớn hơn ngày hiện tại',
            'c_end_time.after'      => 'Ngày kết thúc phải lớn hơn ngày bắt đầu và ngày hiện tại',
        ];
    }
}
