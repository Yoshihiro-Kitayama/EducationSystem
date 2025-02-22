<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/article.css') }}">
    <title>Document</title>
</head>
<body>
@extends('user.layouts.app')

@section('content')
<div class="article-container">
    <a href="#" class="back-link">← 戻る</a>
    <p class="posted-date">{{ $article->posted_date }}</p>
    <h2 class="article-title">{{ $article->title }}</h2>
    <p class="article-content">{{ $article->article_contents }}</p>
</div>
@endsection


</body>
</html>
