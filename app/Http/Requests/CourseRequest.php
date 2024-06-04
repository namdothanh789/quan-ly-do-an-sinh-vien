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
        ];

        if ($request->submit == 'create') {
            $rules['c_start_time'] = 'required|after:today';
            if ($this->request->has('c_start_time') && $this->request->get('c_start_time') != $this->request->get('c_end_time')) {
                $rules['c_end_time'] = 'required|after:c_start_time';
            } else {
                $rules['c_end_time'] = 'required|after:today';
            }
        }
        if ($request->submit == 'update') {
            if ($this->request->has('c_start_time') && $this->request->get('c_start_time') != $this->request->get('c_start_time')) {
                $rules['c_end_time'] = 'required|after:c_start_time';
            }
        }

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
