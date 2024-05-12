<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarFileResultRequest extends FormRequest
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
            'file_result' => 'required|mimes:docx,doc,zip,pdf',
        ];
    }

    public function messages()
    {
        return [
            'file_result.required' => 'Dữ liệu không được phép để trống.',
            'images.mimes'         => 'Vui lòng nhập đúng định dạng file',
        ];
    }
}