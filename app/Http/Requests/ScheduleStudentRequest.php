<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\User;

class ScheduleStudentRequest extends FormRequest
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
            'users' => ['required'],
            'n_content' =>['required'],
            'n_from_date' =>['required'],
            'n_end_date' =>['required'],
        ];
//        if ($request->n_send_to == User::STUDENT) {
//            $rule['n_course_id'] = ['required'];
//        }
        return $rule;
    }

    public function messages()
    {
        return [
            'n_title.required' => 'Dữ liệu không thể để trống',
            'users.required' => 'Dữ liệu không thể để trống',
            'n_content.required' => 'Dữ liệu không thể để trống',
            'n_from_date.required' => 'Dữ liệu không thể để trống',
            'n_end_date.required' => 'Dữ liệu không thể để trống',
        ];
    }
}
