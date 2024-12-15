<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CurriculumController extends Controller
{
    // カリキュラム一覧を表示
    public function index($grade_id = null)
    {
        //$grade_id が指定されていない場合にデフォルト学年を選択
        if (is_null($grade_id)) {
            $grade_id = Grade::min('id'); // デフォルト学年を最小IDとする
        }
        
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
            $url = Storage::url($thumbnailPath);
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

        return redirect()->route('show.curriculum.list',['grade_id' => $curriculum->grade_id])->with('success', 'カリキュラムが更新されました');
    }

    public function create()
    {
        $grades = Grade::all();
        $curriculum = new Curriculum(); // 空のオブジェクトを作成

    return view('curriculum_create', compact('grades', 'curriculum'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate(
            [
                'title' => 'required|string|min:1|max:255',
                'thumbnail' => 'nullable|image',
                'description' => 'required|string',
                'video_url' => 'required|url',
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
            ]
        );

        // チェックボックス値を整数に変換
        $alwayDeliveryFlg = $request->has('alway_delivery_flg') ? 1 : 0;
        // サムネイル画像の処理
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // カリキュラムをデータベースに保存
        Curriculum::create([
            'title' => $validated['title'],
            'thumbnail' => $thumbnailPath,
            'description' => $validated['description'],
            'video_url' => $validated['video_url'],
            'alway_delivery_flg' => $alwayDeliveryFlg, // デフォルト値またはリクエストの値
            'grade_id' => $validated['grade_id'],
        ]);

        // 成功メッセージとリダイレクト
        return redirect()->route('show.curriculum.list')->with('success', 'カリキュラムが作成されました');
    }
}
