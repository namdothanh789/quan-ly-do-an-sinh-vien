<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThesisBookRequest extends FormRequest
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
            'result_book_file_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'result_book_file_id.required' => 'Vui lòng chọn file cần nhận sét',
        ];
    }
}