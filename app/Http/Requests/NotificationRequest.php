<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\User;

class NotificationRequest extends FormRequest
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
        $rule = [
            'n_title' => ['required'],
            'n_content' =>['required'],
        ];
        if ($request->n_send_to == User::STUDENT) {
            $rule['n_course_id'] = ['required'];
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'n_title.required' => 'Dữ liệu không thể để trống',
            'n_course_id.required' => 'Dữ liệu gửi cho sinh viên vui lòng chọn niên khóa',
            'n_content.required' => 'Dữ liệu không thể để trống',
        ];
    }
}
