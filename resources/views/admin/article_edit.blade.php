@extends('admin.layouts.app')

@section('content')
    <div class="container">
        
        <!-- 戻るリンク -->
        <a href="{{ route('admin.dashboard') }}">← 戻る</a>

        <h2>お知らせ変更</h2>
        
        <form action="{{ route('admin.article.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="published_at">投稿日時</label>
            <input type="datetime-local" id="posted_date" name="posted_date" value="{{ old('posted_date', $article->posted_date) }}">

            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" >

            <label for="content">本文</label>
            <textarea id="content" name="content" >{{ $article->article_contents }}</textarea>

            <button type="submit">登録</button>
        </form>
    </div>
@endsection
