<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスは入力必須です。',
            'password.required' => 'パスワードは入力必須です。',
            'email.email' => '入力したメールアドレスは有効ではありません。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'password.min' => 'パスワード8文字以上で入力してください',
            'password.confirmed' => 'パスワードが一致しません',
        ];
    }
}