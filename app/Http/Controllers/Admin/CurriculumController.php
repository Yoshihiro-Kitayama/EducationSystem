<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Http\Requests\StoreCurriculumRequest;
use App\Http\Requests\UpdateCurriculumRequest;
use Illuminate\Support\Facades\DB; // DBファサードを追加

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
        return view('admin.curriculum_list', compact('curriculums', 'selectedGrade', 'grades', 'grade_id'));
    }

    public function edit($curriculums_id)
    {
        $curriculum = Curriculum::findOrFail($curriculums_id); // IDでカリキュラムを検索
        $grades = Grade::all(); // grades テーブルから全ての学年を取得

        return view('admin.curriculum_edit', compact('curriculum', 'grades', 'curriculums_id'));
    }

    public function update(UpdateCurriculumRequest $request, $curriculums_id)
    {
        $curriculum = Curriculum::findOrFail($curriculums_id);
        try {
            // トランザクション開始（以降のDB操作はすべて一連の処理として扱われる）
            DB::beginTransaction();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $curriculum->thumbnail = $thumbnailPath;
            }
            //データ更新
            $curriculum->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'video_url' => $request->input('video_url'),
                'alway_delivery_flg' => $request->has('alway_delivery_flg') ? 1 : 0,
                'grade_id' => $request->input('grade_id'),
            ]);
            // 更新を保存
            $curriculum->save();
            // トランザクションをコミット　すべてのDB操作が成功したらコミットして確定
            DB::commit();
            return redirect()->route('curriculum.list', ['grade_id' => $curriculum->grade_id])
                         ->with('success', 'カリキュラムが更新されました');
        } catch (\Exception $e) {
            // エラー発生時にロールバック（変更取り消し）
            DB::rollBack();
    
            // エラーメッセージを表示
            return back()->with('error', 'カリキュラムの更新中にエラーが発生しました: ' . $e->getMessage());
        }
    }


    public function create()
    {
        $grades = Grade::all();
        $curriculum = new Curriculum(); // 空のオブジェクトを作成

    return view('admin.curriculum_create', compact('grades', 'curriculum'));
    }

    public function store(StoreCurriculumRequest $request)
    {
        $alwayDeliveryFlg = $request->has('alway_delivery_flg') ? 1 : 0;
        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Curriculum::create([
            'title' => $request->input('title'),
            'thumbnail' => $thumbnailPath,
            'description' => $request->input('description'),
            'video_url' => $request->input('video_url'),
            'alway_delivery_flg' => $alwayDeliveryFlg,
            'grade_id' => $request->input('grade_id'),
        ]);

        return redirect()->route('show.curriculum.list')
                         ->with('success', 'カリキュラムが作成されました');
    }
}
