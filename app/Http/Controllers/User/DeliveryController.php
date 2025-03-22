<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\CurriculumProgress;
use App\Models\DeliveryTimes;
use Carbon\Carbon;

use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{

    public function __construct()
{
    $this->middleware('auth')->except('showLogin');
}

// 授業一覧ページの表示
public function showDelivery($curriculum_id)
{
    // $grades = Grade::all();

    $curriculum = Curriculum::find($curriculum_id);


        $curriculumProgress = CurriculumProgress::where('curriculums_id', $curriculum->id)
                ->where('users_id', auth()->id())
                ->first();

        $grade = Grade::find($curriculum->grade_id);

        $deliveryPeriod = false;

        $now = Carbon::now();
        $deliveryTime = DeliveryTimes::where('curriculums_id', $curriculum->id)->first();

            if ($deliveryTime) {
                $deliveryFrom = Carbon::parse($deliveryTime->delivery_from);
                $deliveryTo = Carbon::parse($deliveryTime->delivery_to);
                $deliveryPeriod = $now->between($deliveryFrom, $deliveryTo);
            }

    return view('user.layouts.delivery', compact('curriculum', 'curriculumProgress', 'grade', 'deliveryPeriod'));
}


    // 受講しましたボタン↓

    public function updateProgress(Request $request){

        $curriculumId = $request->input('curriculum_id');
        $userId = auth()->id();

        try {
            $curriculumProgress = CurriculumProgress::where('curriculums_id', $curriculumId)
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



