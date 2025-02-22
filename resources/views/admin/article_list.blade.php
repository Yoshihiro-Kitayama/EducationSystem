@extends('admin.layouts.app')





@section('content')
    <div class="container">
    <link rel="stylesheet" href="{{ asset('css/admin_article_list.css') }}">
    
        <!-- 戻るリンク -->
        <a href="{{ route('admin.dashboard') }}" class="back-link">← 戻る</a>

        <!-- タイトル -->
        <h2>お知らせ一覧</h2>

        <!-- 新規登録ボタン -->
        <a href="{{ route('admin.article.create') }}" class="btn btn-primary">新規登録</a>

        <!-- お知らせ一覧テーブル -->
        <table class="table">
            <thead>
                <tr>
                    <th>更新日</th>
                    <th>タイトル</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($article->updated_at)->format('Y年m月d日') }}</td>
                        <td>{{ $article->title }}</td>
                        <td>
                            <div class="action-buttons">
                                <!-- 変更ボタン -->
                                <a href="{{ route('admin.article.edit', $article->id) }}" class="btn btn-info">変更</a>
                                
                                <!-- 削除ボタン -->
                                <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">削除</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
