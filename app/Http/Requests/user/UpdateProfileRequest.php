<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            // 画像ファイルのバリデーション
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // ユーザーネームのバリデーション
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[ぁ-んァ-ヶ一-龥a-zA-Z0-9]+$/u' // 日本語・英数字のみ許可
            ],

            // カナのバリデーション
            'name_kana' => [
                'required',
                'string',
                'max:255',
                'regex:/^[ァ-ヶー]+$/u' // カタカナのみ許可
            ],

            // メールアドレスのバリデーション
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . Auth::id()
            ],
        ];
    }

    public function messages(): array
    {
        return [
            // プロフィール画像のエラーメッセージ
            'profile_image.image'  => 'プロフィール画像は、画像ファイルを選択してください。',
            'profile_image.mimes'  => 'プロフィール画像は、JPEG, PNG, JPG, GIF のいずれかを選択してください。',
            'profile_image.max'    => 'プロフィール画像のサイズは2MB以下にしてください。',

            // ユーザーネームのエラーメッセージ
            'name.required'  => 'ユーザーネームは入力必須項目です。',
            'name.max'       => 'ユーザーネームは２５５文字未満で入力してください。',
            'name.regex'     => 'ユーザーネームを正しく入力してください。',

            // カナのエラーメッセージ
            'name_kana.required' => 'カナは入力必須項目です。',
            'name_kana.max'      => 'カナは２５５文字未満で入力してください。',
            'name_kana.regex'    => 'カナはカタカナで入力してください。',

            // メールアドレスのエラーメッセージ
            'email.required'  => 'メールアドレスは入力必須項目です。',
            'email.email'     => 'メールアドレスはメールアドレス形式で入力してください。',
            'email.max'       => 'メールアドレスは２５５文字未満で入力してください。',
            'email.unique'    => 'このメールアドレスは既に使用されています。',
        ];
    }
}
