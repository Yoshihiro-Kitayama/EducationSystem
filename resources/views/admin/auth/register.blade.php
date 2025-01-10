<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>管理ユーザー新規登録</title>
</head>
<body>
<div class="admin_register">
    <div class="admin_register_contents">
        <a href="{{ route('admin.show.login') }}" class="admin_register_login-navigation">ログインはこちら</a>
        <div class="admin_register_box">
            <div class="admin_register_title">新規管理ユーザー登録</div>

            <div class="admin_register_forms">
                <form method="POST" action="{{ route('admin.register.submit') }}">
                    @csrf

                    <div class="admin_register_form">
                        <label for="name" class="admin_register_form_label">ユーザーネーム</label>

                        <div class="admin_register_form_input">
                            <input id="name" type="text" class="admin_register_form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="admin_register_form_feedback" role="alert">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="admin_register_form">
                        <label for="kana" class="admin_register_form_label">カナ</label>

                        <div class="admin_register_form_input">
                            <input id="kana" type="text" class="admin_register_form-control @error('kana') is-invalid @enderror" name="kana" value="{{ old('kana') }}" required autocomplete="kana" >

                            @error('kana')
                                <span class="admin_register_form_feedback" role="alert">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="admin_register_form">
                        <label for="email" class="admin_register_form_label">メールアドレス</label>

                        <div class="admin_register_form_input">
                            <input id="email" type="email" class="admin_register_form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="admin_register_form_feedback" role="alert">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="admin_register_form">
                        <label for="password" class="admin_register_form_label">パスワード</label>

                        <div class="admin_register_form_input">
                            <input id="password" type="password" class="admin_register_form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="admin_register_form_feedback" role="alert">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="admin_register_form">
                        <label for="password-confirm" class="admin_register_form_label">パスワード確認</label>

                        <div class="admin_register_form_input">
                            <input id="password-confirm" type="password" class="admin_register_form-control" name="password_confirmation" required autocomplete="new-password">
                            @error('password_confirmation')
                                <span class="admin_register_form_feedback" role="alert">
                                    <strong><br>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="admin_register_form_register_btn">
                        登録
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>



