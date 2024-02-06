<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutlineRequest extends FormRequest
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
            'st_outline' => ['required'],
            'outline_part' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'st_outline.required' => 'Dữ liệu không được phép để trống.',
            'outline_part.required' => 'Dữ liệu không được phép để trống.',
        ];
    }
}