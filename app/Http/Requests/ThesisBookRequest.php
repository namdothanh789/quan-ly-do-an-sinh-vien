<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisBookRequest extends FormRequest
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
            'st_thesis_book' => ['required'],
            'thesis_book' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'st_thesis_book.required' => 'Dữ liệu không được phép để trống.',
            'thesis_book.required' => 'Dữ liệu không được phép để trống.',
        ];
    }
}