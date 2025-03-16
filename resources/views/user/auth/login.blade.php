
<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ログイン画面</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>
<body>

        <div class="header">
            <a class="nav-link" href="{{ route('register') }}">新規会員登録はこちら</a>
        </div>

<br>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="info-input">

                    <h2 class="title">ログイン</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row address">
                            <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>

                            <div class="col-md-6">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                @error('password')
                                    <span class="error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>

                        <div class="row mb-0">
                            <div class="loginbtn-box">
                                <button type="submit" class="submitbtn">
                                    ログイン
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>

</body>
</html>

