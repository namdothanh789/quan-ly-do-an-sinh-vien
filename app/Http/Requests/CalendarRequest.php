<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CalendarRequest extends FormRequest
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
            'title'     => 'required',
            'contents'     => 'required',
            'status'     => 'required',
            'type'     => 'required',
        ];

        if ($request->submit == 'create') {
            $rules['start_date'] = 'nullable|after:today';
            if ($this->request->has('start_date') && $this->request->get('start_date') != $this->request->get('end_date')) {
                $rules['end_date'] = 'nullable|after:start_date';
            } else {
                $rules['end_date'] = 'nullable|after:today';
            }
        }
        if ($request->submit == 'update') {
            if ($this->request->has('start_date') && $this->request->get('start_date') != $this->request->get('end_date')) {
                $rules['start_date'] = 'nullable';
                $rules['end_date'] = 'nullable|after:start_date';
            }
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required'       => 'Dữ liệu không được phép để trống',
            'contents.required'            => 'Dữ liệu không được phép để trống',
            'status.required'            => 'Dữ liệu không được phép để trống',
            'type.required'            => 'Cần chọn loại file báo cáo/file đồ án',
            'start_date.required'            => 'Dữ liệu không được phép để trống',
            'end_date.required'            => 'Dữ liệu không được phép để trống',
            'start_date.after'            => 'Ngày bắt đầu phải lớn hơn ngày hiện tại',
            'end_date.after'            => 'Ngày kết thúc phải lớn hơn ngày bắt đầu và ngày hiện tại',
        ];
    }
}
