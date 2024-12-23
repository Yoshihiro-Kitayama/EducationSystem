<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認証が必要ない場合はtrue
    }

    public function rules()
    {
        return [
            'delivery_times.*.delivery_from' => 'required|date',
            'delivery_times.*.delivery_to' => 'required|date|after_or_equal:delivery_times.*.delivery_from',
        ];
    }

    public function messages()
    {
        return [
            'delivery_times.*.delivery_from.required' => '配信開始日時を入力してください。',
            'delivery_times.*.delivery_to.required' => '配信終了日時を入力してください。',
            'delivery_times.*.delivery_to.after_or_equal' => '配信終了日時は開始日時以降である必要があります。',
        ];
    }
}