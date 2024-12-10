<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\Grade;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class CurriculumController extends Controller
{
    // カリキュラム一覧を表示
    public function index($grade_id)
    {
        //カリキュラムとその関連する配信期間を取得
        $curriculums = Curriculum::with('deliveryTimes')
                                    ->where('grade_id', $grade_id)
                                    ->get();
        $selectedGrade = Grade::find($grade_id);
        // gradesテーブルのデータを取得（学年のリンク用）
        $grades = Grade::all();
        return view('curriculum_list', compact('curriculums', 'selectedGrade', 'grades', 'grade_id'));
    }

    public function edit($grade_id)
    {
        $curriculum = Curriculum::findOrFail($grade_id); // IDでカリキュラムを検索
        $grades = Grade::all(); // grades テーブルから全ての学年を取得

        return view('curriculum_edit', compact('curriculum', 'grades', 'grade_id'));
    }

    public function update(Request $request, $grade_id)
    {
        
        // カリキュラムの取得
        $curriculum = Curriculum::findOrFail($grade_id);
        // バリデーション
            $request->validate([
            'title' => 'required|string|min:1|max:255',
            'thumbnail' => 'nullable|image',
            'description' => 'required|string',
            'video_url' => 'required|url',
            'alway_delivery_flg' => 'nullable|boolean',
            'grade_id' => 'required|exists:grades,id',
        ],
        [
            'title.required' => '授業名は必須です。',
            'title.max' => '255文字以内で入力してください。',
            'thumbnail.image' => '登録できる画像形式はjpg,png形式です。',
            'description.required' => '授業概要は入力必須です。',
            'video_url.required' => '授業URLは入力必須です。',
            'video_url.url' => 'URL形式で入力してください。',
            'grade_id.required' => '学年は入力必須です。',
        ]);

        // サムネイル画像の処理
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $curriculum->thumbnail = $thumbnailPath;
        }

        // データの更新
        $curriculum->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'video_url' => $request->input('video_url'),
            'alway_delivery_flg' => $request->has('alway_delivery_flg') ? 1 : 0,
            'grade_id' => $request->input('grade_id'),
        ]);
        
        // 更新を保存
        $curriculum->save();

        return redirect()->route('show.curriculum.list',['grade_id' => $grade_id])->with('success', 'カリキュラムが更新されました');
    }
}
