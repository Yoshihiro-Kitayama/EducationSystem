<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'name_kana' => ['required', 'string', 'max:255' ,'regex:/^[ァ-ヶー]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    public function attributes()
{
    return [
        'name' => 'ユーザーネーム',
        'name_kana' => 'カナ',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード確認',
    ];
}

/**
 * エラーメッセージ
 *
 * @return array
 */
public function messages() {
    return [
        'name.required' => ':attributeは入力必須です。',
        'name.max' => ':attributeは:max字以内で入力してください。',
        'name_kana.required' => ':attributeは入力必須です。',
        'name_kana.max' => ':attributeは:max字以内で入力してください。',
        'name_kana.regex' => ':attributeはカタカナ入力のみ有効です。',
        'email.required' => ':attributeは必須項目です。',
        'password.required' => ':attributeは入力必須です。',
        'password.min' => ':attributeは:min字以上で入力してください。',
        'password.confirmed' => 'パスワードと確認用パスワードが一致しません。',
        'password_confirmation.required' => ':attributeは入力必須です。',
    ];
}
}
