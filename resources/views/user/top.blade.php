<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザーダッシュボード</title>
    @extends('user.layouts.app')
</head>
<body>
    <h1>ようこそ、ユーザー専用ページへ！</h1>
    <a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
