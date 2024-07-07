<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultFileRequest extends FormRequest
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
            'rf_title' => 'required|max:255',
            'rf_path' => [
                'required',
                'file',
                'max:10240',
                function ($attribute, $value, $fail) {
                    $allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'pptx', 'zip'];
                    $extension = strtolower($value->getClientOriginalExtension());
                    
                    if (!in_array($extension, $allowedExtensions)) {
                        $fail('Các định dạng file được phép tải lên: ' . implode(', ', $allowedExtensions) . '.');
                    }
                },
            ],
            'rf_type' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'rf_title.required' => 'Tiêu đề không được để trống.',
            'rf_title.max' => 'Tiêu đề không được quá 255 ký tự.',
            'rf_path.required' => 'Chưa upload file.',
            'rf_path.file' => 'File không hợp lệ.',
            'rf_path.max' => 'Kích thước file không quá 10MB.',
            'rf_path.mimes' => 'Loại file hợp lệ: pdf, doc, docx, xls, xlsx, pptx, zip.',
            'rf_type.required' => 'Cần chọn loại file.',
        ];
    }
}
