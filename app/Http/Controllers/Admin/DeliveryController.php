<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTime;
use App\Models\Curriculum;
use App\Http\Requests\UpdateDeliveryRequest;
use Illuminate\Support\Facades\DB; // DBファサードをインポート

class DeliveryController extends Controller
{
    // 編集画面を表示
    public function edit($curriculums_id)
    {
        $selectedCurriculum = Curriculum::find($curriculums_id);
        $deliveryTimes = DeliveryTime::where('curriculums_id', $curriculums_id)->get(); // 配信日時データを取得
        
        return view('admin.delivery', compact('deliveryTimes', 'curriculums_id', 'selectedCurriculum'));
    }

    // 編集内容を更新
    public function update(UpdateDeliveryRequest $request, $curriculums_id)
    {
        try {
            // トランザクション開始
            DB::beginTransaction();

            // 1. 既存の配信時間を削除する
            DeliveryTime::where('curriculums_id', $curriculums_id)->delete();

            // 2. 新しい配信時間を保存する
            $deliveryTimes = $request->validated()['delivery_times'];

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

            // トランザクションをコミット
            DB::commit();

            // 3. 一覧ページへリダイレクト
            return redirect()->route('delivery.edit', ['curriculums_id' => $curriculums_id])
                            ->with('success', '配信時間が更新されました。');

        } catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollBack();

            // エラーメッセージを返す
            return back()->with('error', '配信時間の更新中にエラーが発生しました: ' . $e->getMessage());
        }
    }
}