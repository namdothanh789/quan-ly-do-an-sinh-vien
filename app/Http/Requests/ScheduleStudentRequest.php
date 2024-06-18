<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

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
            'topic_id' => ['required_without:users'],
            'users' => ['required'],
            'n_schedule_type' => 'required|string',
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
            'topic_id.required_without' => 'Chọn để hiển thị danh sách sinh viên',
            'users.required' => 'Cần chọn sinh viên',
            'n_schedule_type.required' => 'Cần chọn loại cuộc hẹn',
            'meeting_type.required' => 'Cần chọn loại lịch offline/online',
            'location.required_if' => 'Địa điểm không thể để trống',
            'location_details.required_if' => 'Địa điểm chi tiết không thể để trống',
            'n_from_date.required' => 'Cần chọn thời gian bắt đầu',
            'n_end_date.required' => 'Cần chọn thời gian kết thúc',
            'n_content.required' => 'Dữ liệu không thể để trống',
        ];
    }
}
