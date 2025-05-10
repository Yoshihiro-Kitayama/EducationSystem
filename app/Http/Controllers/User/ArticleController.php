<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct()
{
    $this->middleware('auth')->except('showLogin');
}

    public function showArticle(Request $request)
    {
        $articles = Article::all();

        return view('user.layouts.article', compact('articles'));
    }

}
