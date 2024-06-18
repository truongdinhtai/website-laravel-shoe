<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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

    public function rules()
    {
        return [
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống',
            'password.required'              => 'Mật khẩu không được để trống',
            'password.confirmed'             => 'Mật khẩu xác nhận không khớp',
            'password.min'                   => 'Mật khẩu ít nhất 6 ký tự',
        ];
    }
}
