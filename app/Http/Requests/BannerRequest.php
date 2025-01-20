<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'image' => [
                        // 'required',
                        'image',
                        'mimes:jpeg,png,jpg,gif',
                        'max:2048',
                        'not_regex:/[\\/:\*\?"<>\|]/',
                        function ($attribute, $value, $fail){
                        if($value instanceof \Illuminate\Http\UploadedFile){ 
                          if(mb_strlen($value->getClientOriginalName()) > 255){
                            $fail(trans('validation.file_name_max'));
                        }
                    }
                },
            ],
        ];
    }

    public function messages(){
        return[
            // 'image.required' =>'画像が選択されていません。',
            'image.image' =>'アップロードできるファイルは画像である必要があります。',
            'image.mimes' =>'画像はjpeg, png, jpg, gifを選択してください。',
            'image.max' =>'ファイルサイズは2MB以下にしてください。',
            'image.not_regex' => '「ファイル名に特殊文字（例: /, \, ?, *）は使用できません。',
            'file_name_max' => 'ファイル名は255文字以内にしてください。',
        ];
    }
}
