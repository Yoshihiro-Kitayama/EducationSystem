@extends('admin.layouts.app')

@section('content')
    <div class="container">
    <link rel="stylesheet" href="{{ asset('css/admin_article_edit.css') }}">
    
        <!-- 戻るリンク -->
        <a href="{{ route('admin.article.list') }}" class="back-link">← 戻る</a>

        <h2>お知らせ新規登録</h2>
        
        <form action="{{ route('admin.article.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="posted_date">投稿日時</label>
        <input type="datetime-local" id="posted_date" name="posted_date" value="{{ old('posted_date') }}">
        @error('posted_date')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="title">タイトル</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}">
        @error('title')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="article_contents">本文</label>
        <textarea id="article_contents" name="article_contents">{{ old('article_contents') }}</textarea>
        @error('article_contents')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">登録</button>
</form>

    </div>
@endsection
