<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'old_password' => [
                'required',
                'current_password',
                'regex:/^[a-zA-Z0-9]+$/', // 特殊文字を含めない
            ],
            'new_password' => [
                'required',
                'min:8',
                'max:254',
                'regex:/^[a-zA-Z0-9]+$/', // 英数字のみ
                'confirmed',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => '旧パスワードは入力必須項目です。',
            'old_password.current_password' => '現在設定されているパスワードと一致しません。',
            'old_password.regex' => '旧パスワードには特殊文字を使用できません。',
            
            'new_password.required' => '新パスワードは入力必須項目です。',
            'new_password.min' => '新パスワードは８文字以上で入力してください。',
            'new_password.max' => '新パスワードは２５５文字未満で入力してください。',
            'new_password.regex' => '新パスワードは英数字で入力してください。',
            'new_password.confirmed' => '新パスワードと一致しません。',
        ];
    }
}
