<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserProfileRequest extends FormRequest
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
            'profile_image' => ['nullable', 'image', 'max:51200'], // 50MB = 51200KB
            'name' => ['required', 'max:255'],
            'name_kana' => ['required', 'max:255', 'regex:/^[ァ-ヶー]+$/u'],
            'email' => ['required', 'email', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'profile_image.max' => '* 画像サイズが50MBを超えています',
            'name.required' => '* ユーザーネームは入力必須項目です',
            'name.max' => '* ユーザーネームは英数字のみの場合で255文字以内、日本語（漢字、ひらがな、カタカナなど）を含む場合で約85文字以内で入力してください',
            'name_kana.required' => '* カナは入力必須項目です',
            'name_kana.max' => '* カナは英数字のみの場合で255文字以内、日本語（漢字、ひらがな、カタカナなど）を含む場合で約85文字以内で入力してください',
            'name_kana.regex' => '* カナはカタカナで入力してください',
            'email.required' => '* メールアドレスは入力必須項目です',
            'email.email' => '* 有効なメールアドレスを入力してください',
            'email.max' => '* メールアドレスは英数字のみの場合で255文字以内、日本語（漢字、ひらがな、カタカナなど）を含む場合で約85文字以内で入力してください',
        ];
    }
}
