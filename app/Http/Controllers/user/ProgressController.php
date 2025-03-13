<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CurriculumProgress;
use App\Models\Curriculum;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 全学年のカリキュラムを取得（カリキュラムと一緒に取得）
        $grades = Grade::with('curriculums')->get();

        // ユーザーの進捗データを取得
        $progress = CurriculumProgress::where('users_id', $user->id)->get();

        return view('user.curriculum_progress', compact('user', 'grades', 'progress'));
    }
}
