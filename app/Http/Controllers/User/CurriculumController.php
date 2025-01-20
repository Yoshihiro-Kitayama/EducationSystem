<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\User;
use App\Models\CurriculumClearCheck;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CurriculumController extends Controller
{
        public function showCurriculumList(Request $request){
        //現在のユーザーの情報を取得
        $user = Auth::user();
        // 学年を取得、初期値は1
        $grade_id = $request->input('grade_id', 1);
        $grade = Grade::find($grade_id);
        $grades = Grade::all();
        $grade_name = $grade->name;
        //カリキュラムをクリアしているかを取得する。
        $curriculum_clear_data = $this->getCurriculumDate($user);

        //月データ取得
        $get_month = $this->getMonth($request->query('month'));
        $current_month = $get_month['current_month'];
        $month_start = $get_month['month_start'];
        $month_end = $get_month['month_end'];
        //カリキュラムデータの取得
        $curriculums = Curriculum::getCurriculumList($grade_id, $month_start, $month_end);
        $getAdjustedDeliveryTimes = Curriculum::getDeliveryTimesGrouped($curriculums, $month_start, $month_end);

        // ヘッダーの前月、来月の処理
        $curriculum_grade_navigation = $this->showCurriculumListNavigation($current_month, $grade_id);
        $prev_month_route = $curriculum_grade_navigation['prev_month_route'];
        $next_month_route = $curriculum_grade_navigation['next_month_route'];

        // サイドバーの学年のボタンの装飾を変更するための処理
        $gradedColors = $grades->map(function ($grade){
            $grade->color = $grade->id <= 6? '1' :
                            ($grade->id >= 7 && $grade->id <= 9 ? '2': '3');
            return $grade;
        });

        //ヘッダーの学年のボタンの装飾を変更するための処理
        $grade_color = $grade_id <= 6 ? '1' :
                      ($grade_id >= 7 && $grade_id <= 9 ? '2' : '3');

        //ajaxでの非同期の場合、jsonでreturn
        if ($request->ajax()) {
            return response()->json(['grade_name' => $grade_name, 
                                     'current_month' => $current_month, 
                                     'prev_month_route' => $prev_month_route, 
                                     'next_month_route' => $next_month_route, 
                                     'curriculums' => $curriculums,
                                     'getAdjustedDeliveryTimes' => $getAdjustedDeliveryTimes, 
                                     'grade_color' => $grade_color, 
                                     'curriculum_clear_data' => $curriculum_clear_data ]
             );
        }

        //それ以外のビューのreturn
        return view('user.layouts.curriculum_list', compact('user','grade_id', 'grades', 'grade', 'grade_color','grade_name', 'month_start','month_end','current_month',
                                                    'curriculum_clear_data','curriculums','getAdjustedDeliveryTimes',
                                                    'prev_month_route','next_month_route', 'gradedColors'));
        
        
    }
    // ユーザーの受講中、またはクリアしたカリキュラムを取得するためのメソッド
    public function getCurriculumDate($user){
        return $user->getCurriculumClearOrAttendance();
    }
    
    // カリキュラムヘッダー用の来月先月を切り替えるためのルーティング生成用メソッド
    public function showCurriculumListNavigation($current_month, $grade_id){
        //現在の月からCarbonを使用し、一月引き、年-月の形にして取得
        $prev_month = \Carbon\Carbon::parse($current_month)->subMonth()->format('Y-m');
        //現在の月からCarbonを使用し、一月足し、年-月の形にして取得
        $next_month = \Carbon\Carbon::parse($current_month)->addMonth()->format('Y-m');
        // ルーティングをしてリターン
        return [
            'prev_month_route' => route('user.show.curriculum', ['month' => $prev_month, 'grade_id' => $grade_id]),
            'next_month_route' => route('user.show.curriculum', ['month' => $next_month, 'grade_id' => $grade_id]),
        ];
    }

    //表示する月データを取得するメソッド
    public function getMonth($month = null){
        $current_month = Carbon::parse($month ?? Carbon::now()->format('Y-m'));
        return [
            'current_month' => $current_month,
            'month_start' => $current_month->copy()->startOfMonth(),
            'month_end' => $current_month->copy()->endOfMonth(),
        ];
    }

}