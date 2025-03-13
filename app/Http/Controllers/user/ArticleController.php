<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  // ✅ 追加
use App\Models\Article;

class ArticleController extends Controller
{
    public function user_article($id){
        $article = Article::find($id); 

        return view('user/article')->with([
            'article' => $article,

        ]);


    }
}
