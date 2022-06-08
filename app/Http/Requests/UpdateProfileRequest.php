<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore(Auth::id()),],
            'avatar' => 'mimes:jpg,png,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'email.unique' => 'Email telah digunakan',
            'avatar' => 'ekstensi gambar harus jpg/png',
        ];
    }
}
