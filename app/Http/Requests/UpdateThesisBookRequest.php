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
            'st_thesis_book' => 'required | max:225',
        ];
    }

    public function messages()
    {
        return [
            'st_thesis_book.required' => 'Vui lòng nhập vào dữ liệu',
        ];
    }
}