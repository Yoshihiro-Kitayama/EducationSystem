<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurriculumRequest extends FormRequest
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
            'title' => 'required|string|min:1|max:255',
            'thumbnail' => 'nullable|image',
            'description' => 'required|string',
            'video_url' => 'required|url',
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
