<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'posted_date' => ['required', 'date'],
            'title' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\p{N}\s]+$/u'],
            'article_contents' => ['required', 'string', 'regex:/^[\p{L}\p{N}\s]+$/u'],
        ];
    }

    public function messages(): array
    {
        return [
            'posted_date.required' => '投稿日時は入力必須項目です。',
            'posted_date.date' => '投稿日時は日付の形式で入力してください。',
            'title.required' => 'タイトルは入力必須項目です。',
            'title.max' => 'タイトルは２５５文字未満で入力してください。',
            'title.regex' => 'タイトルを正しく入力してください。',
            'article_contents.required' => '本文は入力必須項目です。',
            'article_contents.regex' => '本文を正しく入力してください。',
        ];
    }
}
