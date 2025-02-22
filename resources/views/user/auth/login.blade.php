<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>ログイン</h2>
        <form method="POST" action="{{ route('user.login') }}" onsubmit="console.log('フォーム送信');">
            @csrf
            <input type="email" name="email" placeholder="メールアドレス" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <button type="submit">ログイン</button>
        </form>
        <a href="{{ route('user.register') }}">新規会員登録はこちら</a>
    </div>
</body>
</html>
