<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
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
            'name' =>'required|max:255',
            'kana' =>'required|max:255|regex:/\A[ァ-ヴー]+\z/u',
            'email' =>'required|max:255|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:admins',
            'password' =>'required|min:8|regex:/^[a-zA-Z0-9]+$/|confirmed',
            'password_confirmation' =>'required',
        ];
    }

    public function messages()
    {
        return[
            'name.required' =>'名前が入力されていません。',
            'name.max' =>'名前は255文字以下にしてください。',
            'kana.required' =>'カナが入力されていません。',
            'kana.regex' =>'カタカナで入力してください。',
            'kana.max' =>'カナは255文字以下にしてください。',
            'email.required' =>'メールアドレスが入力されていません。',
            'email.max' =>'メールアドレスは255文字以下にしてください。',
            'email.email' =>'メールアドレスは正しい形式で入力してください。（例: example@example.com）',
            'email.regex' =>'メールアドレスには半角英数字と記号「@, ., -, _」のみ使用できます。',
            'email.unique' =>'このメールアドレスは既に登録されています。',
            'password.required' =>'パスワードが入力されていません。',
            'password.min' =>'8文字以上入力してください。',
            'password.regex' =>'半角英数字で入力してください。',
            'password.confirmed' => 'パスワードと確認用パスワードが一致しません。',
            'password_confirmation.required' => '確認用パスワードを入力してください。',
        ];
    }
}
