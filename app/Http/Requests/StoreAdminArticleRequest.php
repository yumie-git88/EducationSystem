<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminArticleRequest extends FormRequest
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
            'posted_date' => ['required'],
            'title' => ['required', 'max:255'],
            'article_contents' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'posted_date.required' => '* 投稿日時は入力必須項目です',
            'title.required' => '* タイトルは入力必須項目です',
            'title.max' => '* タイトルは英数字のみの場合で255文字以内、日本語（漢字、ひらがな、カタカナなど）を含む場合で約85文字以内で入力してください',
            'article_contents.required' => '* 本文は入力必須項目です',
        ];
    }
}
