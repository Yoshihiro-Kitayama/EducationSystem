<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Admin;

class AdminLoginRequest extends FormRequest
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
            'email' =>'required|max:255|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' =>'required|min:8|regex:/^[a-zA-Z0-9]+$/',
        ];
    }

    public function messages()
    {
        return[
        'email.required' =>'メールアドレスが入力されていません。',
        'email.max' =>'メールアドレスは255文字以下にしてください。',
        'email.email' =>'メールアドレスは正しい形式で入力してください。（例: example@example.com）',
        'email.regex' =>'メールアドレスには半角英数字と記号「@, ., -, _」のみ使用できます。',
        'password.required' =>'パスワードが入力されていません。',
        'password.min' =>'8文字以上入力してください。',
        'password.regex' =>'半角英数字で入力してください。',
        ];
    }

}
