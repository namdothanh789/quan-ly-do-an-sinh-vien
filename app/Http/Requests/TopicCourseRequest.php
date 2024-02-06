<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TopicCourseRequest extends FormRequest
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
            //
            'tc_topic_id'  => 'required',
            'tc_course_id'  => 'required',
            'tc_council_id'  => 'required',
            'tc_department_id'  => 'required',
            'tc_teacher_id'  => 'required',
            'tc_registration_number' => ['required'],
            'tc_start_outline' => ['required'],
            'tc_end_outline' => ['required'],
            'tc_start_thesis_book' => ['required'],
            'tc_end_thesis_book' => ['required'],
        ];

//        if ($request->submit == 'create') {
//            $rules['tc_start_time'] = 'nullable|after:today';
//            if ($this->request->has('tc_start_time') && $this->request->get('tc_start_time') != $this->request->get('tc_end_time')) {
//                $rules['tc_end_time'] = 'nullable|after:tc_start_time';
//            } else {
//                $rules['tc_end_time'] = 'nullable|after:today';
//            }
//        }
//        if ($request->submit == 'update') {
//            if ($this->request->has('tc_start_time') && $this->request->get('tc_start_time') != $this->request->get('tc_end_time')) {
//                $rules['tc_end_time'] = 'nullable|after:tc_start_time';
//            }
//        }

        return $rules;
    }

    public function messages()
    {
        return [
            'tc_topic_id.required' => 'Dữ liệu không được phép để trống.',
            'tc_course_id.required' => 'Dữ liệu không được phép để trống.',
            'tc_council_id.required' => 'Dữ liệu không được phép để trống.',
            'tc_department_id.required' => 'Dữ liệu không được phép để trống.',
            'tc_teacher_id.required' => 'Dữ liệu không được phép để trống.',
            'tc_registration_number.required' => 'Dữ liệu không được phép để trống.',
            'tc_start_outline.required'            => 'Dữ liệu không được phép để trống',
            'tc_end_outline.required'            => 'Dữ liệu không được phép để trống',
            'tc_start_thesis_book.required'            => 'Dữ liệu không được phép để trống',
            'tc_end_thesis_book.required'            => 'Dữ liệu không được phép để trống',
        ];
    }
}
