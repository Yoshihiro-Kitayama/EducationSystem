<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/user_header.css') }}">
    <title>共通ヘッダー</title>
</head>
<body>
    <div class="header">
        <ul class="navigation">
            <li><a href="#">時間割</a></li>
            <li><a href="{{ route('user.progress.index') }}">授業進捗</a></li>
            <li><a href="{{ route('user.profile.edit') }}">プロフィール設定</a></li>
        </ul>
        <ul class="auth">
    @if(Auth::guard('user')->check())
        <li><a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a></li>
        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <li><a href="{{ route('user.login') }}">ログイン</a></li>
    @endif
</ul>
    </div>

    <main>
        @yield('content')
    </main>
</body>
</html>
