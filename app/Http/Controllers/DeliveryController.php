<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryTime;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\Curriculum;


class DeliveryController extends Controller
{

    // 編集画面を表示
    public function edit($curriculums_id)
    {
        $selectedCurriculum = Curriculum::find($curriculums_id);
        $deliveryTimes = deliveryTime::where('curriculums_id', $curriculums_id)->get(); // 配信日時データを取得
        
        return view('delivery', compact('deliveryTimes', 'curriculums_id', 'selectedCurriculum'));
    }

    // 編集内容を更新
    public function update(Request $request, $curriculums_id)
    {
        // バリデーション
        try {
            $validated = $request->validate([
                'delivery_times.*.delivery_from' => 'required|date',
                'delivery_times.*.delivery_to' => 'required|date',
            ], [
                'delivery_times.*.delivery_from.required' => '配信開始日時を入力してください。',
                'delivery_times.*.delivery_to.required' => '配信終了日時を入力してください。',
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        // 1. 既存の配信時間を削除する
        // curriculums_id に基づいて既存のすべての配信時間を削除
        DeliveryTime::where('curriculums_id', $curriculums_id)->delete();

        // 2. 新しい配信時間を保存する
        // フォームから送信された新しいデータを保存
        $deliveryTimes = $validated['delivery_times'];
        // 一括挿入用データを作成
        $insertData = [];
        foreach ($deliveryTimes as $data) {
            $insertData[] = [
                'delivery_from' => $data['delivery_from'],
                'delivery_to' => $data['delivery_to'],
                'curriculums_id' => $curriculums_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // 一括挿入
        DeliveryTime::insert($insertData);
        // 3. 一覧ページへリダイレクト
        return redirect()->route('delivery.edit', ['curriculums_id' => $curriculums_id])
                        ->with('success', '配信時間が更新されました。');
    }
    }
