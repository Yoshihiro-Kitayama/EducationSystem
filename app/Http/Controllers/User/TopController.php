<?php

namespace App\Http\Controllers\User;

use App\Models\Banner;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopController extends Controller
{

    public function __construct()
{
    $this->middleware('auth')->except('showLogin');
}

    public function showTop(Request $request)
    {

        // banner.phpを呼び出し
        $banners = Banner::all();
        $articles = Article::all();

        return view('user.layouts.top', compact('banners', 'articles'));
    }
}
