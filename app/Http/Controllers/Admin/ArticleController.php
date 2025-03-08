<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * 記事一覧ページ
     */
    public function list()
    {
        // 🔹 最新の投稿が上に来るようにソート
        $articles = Article::orderBy('posted_date', 'desc')->paginate(10);
        return view('admin.article_list', compact('articles'));
    }

    /**
     * 記事作成ページ
     */
    public function create()
    {
        return view('admin.article_create'); // 作成ページの Blade を指定
    }

    /**
     * 記事の保存処理
     */
    public function store(Request $request)
{
    $request->validate([
        'posted_date' => 'required|date', // 🔹 'published_at' → 'posted_date' に修正
        'title' => 'required|string|max:255',
        'article_contents' => 'required|string',
    ]);

    Article::create([
        'posted_date' => $request->posted_date, // 🔹 修正
        'title' => $request->title,
        'article_contents' => $request->article_contents,
    ]);

    return redirect()->route('admin.article.list')->with('success', 'お知らせを作成しました');
}


    /**
     * 記事編集ページ
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.article_edit', compact('article'));
    }

    /**
     * 記事更新処理
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'posted_date' => 'required|date',
        'title' => 'required|string|max:255',
        'article_contents' => 'required|string',
    ]);

    $article = Article::findOrFail($id);
    
    // 🔹 受け取ったデータで更新
    $article->update([
        'posted_date' => $request->posted_date, 
        'title' => $request->title,
        'article_contents' => $request->article_contents,
    ]);


    return redirect()->route('admin.article.list')->with('success', 'お知らせを更新しました');
}


    /**
     * 記事削除処理
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.article.list')->with('success', 'お知らせを削除しました');
    }


    
}



