<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOutlineRequest extends FormRequest
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
            'result_outline_file_id' => 'required',
            'rf_point' => 'nullable|min:0',
        ];
    }

    public function messages()
    {
        return [
            'result_outline_file_id.required' => 'Vui lòng chọn file đề cương cần nhận xét',
        ];
    }
}