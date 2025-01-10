<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>@yield('title')</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
  <div class="admin_header">
    <div class="admin_header_box">
      <div class="admin_header_left-btn">
        <button onclick="location.href='#'" class="admin_header_curriculum-management" >授業管理</button>
        <button onclick="location.href='#'" class="admin_header_notice-management">お知らせ管理</button>
        <button onclick="location.href='#'" class="admin_header_banner-management">バナー管理</button>
      </div>
      @auth('admin')
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="admin_header_login-logout-btn">ログアウト</button>
      </form>
      @else
        <button class="admin_header_login-logout-btn" onclick="location.href='{{ route('admin.show.login') }}'" >ログイン</button>
      @endif
    </div>
  </div>
    
    @yield('content')
  </div>
</body>
</html>