<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_header.css') }}">
    <title>管理画面</title>
</head>
<body>
    <div class="header">
        <ul class="navigation">
            <li><a href="#">授業管理</a></li>
            <li><a href="{{ route('admin.article.list') }}">お知らせ管理</a></li>
            <li><a href="#">バナー管理</a></li>
        </ul>
        <ul class="auth">
    @if(Auth::guard('admin')->check())
        <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a></li>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <li><a href="{{ route('admin.login') }}">ログイン</a></li>
    @endif
</ul>

    </div>

    <main>
        @yield('content')
    </main>
</body>
</html>
