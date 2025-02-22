<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="register-container">
        <h2>新規会員登録</h2>
        <form method="POST" action="{{ route('user.register') }}">
            @csrf
            <input type="text" name="name" placeholder="ユーザーネーム" required>
            <input type="text" name="name_kana" placeholder="カナ" required>
            <input type="email" name="email" placeholder="メールアドレス" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <input type="password" name="password_confirmation" placeholder="パスワード確認" required>
            <button type="submit">登録</button>
        </form>
        <a href="{{ route('user.login') }}">ログインはこちら</a>
    </div>
</body>
</html>
