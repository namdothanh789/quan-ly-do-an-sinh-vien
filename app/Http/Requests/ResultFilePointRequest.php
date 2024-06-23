<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultFilePointRequest extends FormRequest
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
            'status'    => 'required|in:0,1,2',
            'rf_point' => 'required|regex:/^\d+(\.\d{1})?$/',
            'rf_comment' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'status.required'      => 'Dữ liệu không được phép để trống',
            'rf_point.required' => 'Cần nhập điểm.',
            'rf_point.regex' => 'Điểm dạng thập phân có nhiều nhất 1 chữ số sau dấu phẩy.',
        ];
    }
}
