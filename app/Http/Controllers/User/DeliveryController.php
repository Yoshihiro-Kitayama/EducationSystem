<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\CurriculumProgress;
use App\Models\DeliveryTimes;

use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{

    public function __construct()
{
    $this->middleware('auth')->except('showLogin');
}

public function showDelivery(Request $request)
{
    $curriculums = Curriculum::all();
    $grades = Grade::all();

    $curriculumId = request()->segment(3);
    $curriculum = Curriculum::find($curriculumId);

    // 現在のユーザーの受講状況を取得
    if ($curriculum) { // $curriculum が存在する場合のみ
        $curriculumProgress = CurriculumProgress::where('curriculumus_id', $curriculum->id)
                                                ->where('users_id', auth()->id())
                                                ->first();
    } else {
        $curriculumProgress = null; // または他の適切な値を設定
    }

    // $deliveryTime = DeliveryTimes::where('curriculums_id', $curriculumId)->first();

    // $now = now();

    // $timeOut = false;
    // if ($deliveryTime && $deliveryTime->delivery_from <= $now) {
    //     $timeOut = true;
    // }

    // return view('user.layouts.delivery', compact('curriculums', 'grades', 'curriculum', 'curriculumProgress', 'timeOut'));
    return view('user.layouts.delivery', compact('curriculums', 'grades', 'curriculum', 'curriculumProgress'));
}


    // クリアフラグ↓

    public function updateProgress(Request $request){

        $curriculumId = $request->input('curriculum_id');
        $userId = auth()->id();

        try {
            $curriculumProgress = CurriculumProgress::where('curriculumus_id', $curriculumId)
                                                    ->where('users_id', $userId)
                                                    ->first();

            if ($curriculumProgress) {
                $curriculumProgress->clear_flg = 1;
                $curriculumProgress->save();

                return response()->json(['success' => true]); // JSON 形式で成功を返す

            } else {
                return response()->json(['success' => false, 'message' => 'データが見つかりません。']); // JSON 形式でエラーを返す
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]); // JSON 形式でエラーを返す
        }
    }
}



