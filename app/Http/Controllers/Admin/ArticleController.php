<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * 記事一覧ページ
     */
    public function list()
    {
        $articles = Article::orderBy('posted_date', 'desc')->paginate(10);
        return view('admin.article_list', compact('articles'));
    }

    /**
     * 記事作成ページ
     */
    public function create()
    {
        return view('admin.article_create');
    }

    /**
     * 記事の保存処理
     */
    public function store(StoreArticleRequest $request)
    {
        try {
            Article::storeWithTransaction($request->validated());
            return redirect()->route('admin.article.list')->with('success', 'お知らせを作成しました');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '記事の作成に失敗しました: ' . $e->getMessage()]);
        }
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
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        try {
            $article->updateWithTransaction($request->validated());
            return redirect()->route('admin.article.list')->with('success', 'お知らせを更新しました');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '記事の更新に失敗しました: ' . $e->getMessage()]);
        }
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
