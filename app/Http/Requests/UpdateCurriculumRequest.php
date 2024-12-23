<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurriculumRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:1|max:255',
            'thumbnail' => 'nullable|image',
            'description' => 'required|string',
            'video_url' => 'required|url',
            'alway_delivery_flg' => 'nullable|boolean',
            'grade_id' => 'required|exists:grades,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '授業名は必須です。',
            'title.max' => '255文字以内で入力してください。',
            'thumbnail.image' => '登録できる画像形式はjpg,png形式です。',
            'description.required' => '授業概要は入力必須です。',
            'video_url.required' => '授業URLは入力必須です。',
            'video_url.url' => 'URL形式で入力してください。',
            'grade_id.required' => '学年は入力必須です。',
        ];
    }
}