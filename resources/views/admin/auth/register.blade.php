<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者新規登録</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="register-container">
        <h2>管理者新規登録</h2>
        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <input type="text" name="name" placeholder="管理者名" required>
            <input type="email" name="email" placeholder="メールアドレス" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <input type="password" name="password_confirmation" placeholder="パスワード確認" required>
            <button type="submit">登録</button>
        </form>
        <a href="{{ route('admin.login') }}">ログインはこちら</a>
    </div>
</body>
</html>
