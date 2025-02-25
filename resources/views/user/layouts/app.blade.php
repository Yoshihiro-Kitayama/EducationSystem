<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>教育システム</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" >
            <div class="container">

                    <div class="user_common-header">

                        <button onclick="location.href='#'" class="user_curriculum_list" >時間割</button>
                        <button onclick="location.href='#'" class="user_curriculum_progress">授業進捗</button>
                        <button onclick="location.href='#'" class="user_profile_edit">プロフィール設定</button>

                    </div>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                                <div class="logout">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                    </ul>
            </div>
        </nav>

        <main class="py-4">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
        <script src="{{ asset('/js/main.js') }}"></script>
            @yield('content')
        </main>
    </div>
</body>
</html>
