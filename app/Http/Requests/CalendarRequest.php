<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarRequest extends FormRequest
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
            'title'     => 'required|max:255',
            'contents'  => 'required',
            'status'    => 'required|in:0,1,2',
            'type'      => 'required|in:0,1',
            'start_date' => [
                'required',
            ],
            'end_date' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = $request->input('start_date');
                    if (Carbon::parse($value)->isBefore(Carbon::parse($startDate))) {
                        $fail('Thời gian kết thúc phải trùng hoặc sau thời gian bắt đầu.');
                    }
                },
            ],
        ];

        if ($request->input('status') == 0) {
            $rules['start_date'][] = function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->isBefore(Carbon::now())) {
                    $fail('Thời gian bắt đầu phải sau thời gian hiện tại.');
                }
            };

            $rules['end_date'][] = function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->isBefore(Carbon::now())) {
                    $fail('Thời gian kết thúc phải sau thời gian hiện tại.');
                }
            };
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required'       => 'Dữ liệu không được phép để trống',
            'contents.required'    => 'Dữ liệu không được phép để trống',
            'status.required'      => 'Dữ liệu không được phép để trống',
            'type.required'        => 'Cần chọn loại file báo cáo/file đồ án',
            'start_date.required'  => 'Cần chọn thời gian bắt đầu',
            'end_date.required'    => 'Cần chọn thời gian kết thúc',
        ];
    }
}
