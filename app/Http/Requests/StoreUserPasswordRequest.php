<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => ['required'],
            'new_password' => ['required', 'min:8', 'max:255', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => '* 旧パスワードは入力必須項目です',
            'new_password.required' => '* 新パスワードは入力必須項目です',
            'new_password.min' => '* 新パスワードは8文字以上で入力してください',
            'new_password.max' => '* 新パスワードは255文字以内で入力してください',
            'new_password.confirmed' => '* 新パスワードと新パスワード確認が一致しません',
        ];
    }
}
