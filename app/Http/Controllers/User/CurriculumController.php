<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Http\Controllers\Controller;

class CurriculumController extends Controller
{

    public function __construct()
{
    $this->middleware('auth')->except('showLogin');
}

    public function showCurriculumList(Request $request){

        $curriculums = Curriculum::all();
        $grades = Grade::all();

        return view('user.layouts.curriculum_list', compact('curriculums', 'grades'));
    }

    // クリアフラグ↓

    // public function complete(Request $request, $curriculum_id)
    // {
    //     $user_id = auth()->id(); // ログインユーザーのIDを取得
    //     $grade = GradesClearCheck::where('curriculumus_id', $curriculum_id)
    //         ->where('users_id', $user_id)
    //         ->first();

    //     if ($grade) {
    //         $grade->clear_flg = $grade->clear_flg == 1 ? 0 : 1;
    //         $grade->save();
    //     } else {
    //         GradesClearCheck::create([
    //             'curriculumus_id', $curriculum_id,
    //             'users_id', $user_id,
    //             'clear_flg', 1
    //         ]);
    //     }

    //     return redirect()->back(); // 元のページにリダイレクト
    // }

}
