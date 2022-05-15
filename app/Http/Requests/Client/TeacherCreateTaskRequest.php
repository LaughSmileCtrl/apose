<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class TeacherCreateTaskRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'string|max:500',
            'deadline' => 'required|date',
            'study_id' => 'required|exists:studies,id'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'max' => ':attribute maksimal :max',
            'deadline.date' => 'batas waktu pengumpulan harus berformat tanggal',
        ];
    }
}
