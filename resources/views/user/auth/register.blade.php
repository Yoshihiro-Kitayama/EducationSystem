<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>新規会員登録画面</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>
<body>

        <div class="header">
            <a class="nav-link" href="{{ route('login') }}">ログインはこちら</a>
        </div>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

    <div class="info-input">

        <h2 class="title">新規会員登録</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ユーザーネーム</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name_kana" class="col-md-4 col-form-label text-md-end">カナ</label>

                            <div class="col-md-6">
                                <input id="name_kana" type="text" class="form-control @error('name_kana') is-invalid @enderror" name="name_kana" value="{{ old('name_kana') }}" autocomplete="name_kana" autofocus>

                                @error('name_kana')
                                    <span class="error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">パスワード確認</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">

                                @error('password_confirmation')
                                    <span class="error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="submitbtn">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>