<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>管理ユーザーログイン</title>
</head>
<body>
<div class="admin_loin">
    <div class="admin_login_contents">
                <a href="{{ route('admin.show.register') }}" class="admin_login_register-navigation">新規登録はこちら</a>
        <div class="admin_login_box">
            <div class="admin_login_title">管理画面ログイン</div>
            <div class="admin_login_forms">
                <form method="POST" action="{{ route('admin.login.submit')  }}">
                    @csrf

                    <div class="admin_login_form">
                        <label for="email" class="admin_login_form_label">メールアドレス</label>

                        <div class="admin_login_form_input">
                            <input id="email" type="email" class="admin_login_form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="admin_login_form_feedback" role="alert">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="admin_login_form">
                        <label for="password" class="admin_login_form_label">パスワード</label>

                        <div class="admin_login_form_input">
                            <input id="password" type="password" class="admin_login_form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="admin_login_form_feedback" role="alert">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="admin_login_form_register_btn">
                        ログイン
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
