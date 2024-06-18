<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ScheduleTeacherRequest extends FormRequest
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
        $rule = [
            'n_title' => ['required'],
            'teacher_id' =>['required'],
            'n_schedule_type' => 'required|string',
            'users' => 'required_if:n_schedule_type,red|array',
            'users.*' => 'exists:users,id', // Ensure each selected user exists in the users table
            'meeting_type' => 'required|in:offline,online',
            'location' => 'required_if:meeting_type,offline',
            'location_details' => 'required_if:meeting_type,offline',
            'n_from_date' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isBefore(Carbon::now())) {
                        $fail('Thời gian bắt đầu phải sau thời gian hiện tại.');
                    }
                },
            ],
            'n_end_date' => [
                'required',
                function ($attribute, $value, $fail) {
                    $fromDate = $this->input('n_from_date');
                    if (Carbon::parse($value)->isBefore(Carbon::now())) {
                        $fail('Thời gian kết thúc phải sau thời gian hiện tại.');
                    }
                    if (Carbon::parse($value)->isBefore(Carbon::parse($fromDate))) {
                        $fail('Thời gian kết thúc phải sau thời gian bắt đầu.');
                    }
                },
            ],
            'n_content' =>['required'],
        ];

        return $rule;
    }

    public function messages()
    {
        return [
            'n_title.required' => 'Dữ liệu không thể để trống',
            'teacher_id.required' => 'Dữ liệu không thể để trống',
            'n_schedule_type.required' => 'Cần chọn loại cuộc hẹn',
            'users.required_if' => 'Cần chọn sinh viên cho báo cáo nhóm',
            'meeting_type.required' => 'Cần chọn loại lịch offline/online',
            'location.required_if' => 'Địa điểm không thể để trống',
            'location_details.required_if' => 'Địa điểm chi tiết không thể để trống',
            'n_from_date.required' => 'Cần chọn thời gian bắt đầu',
            'n_end_date.required' => 'Cần chọn thời gian kết thúc',
            'n_content.required' => 'Dữ liệu không thể để trống',
        ];
    }
}
