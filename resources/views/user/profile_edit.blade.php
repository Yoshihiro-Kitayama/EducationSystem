@extends('user.layouts.app')

@section('content')
<div class="profile-edit-container">
    <a href="{{ route('user.top') }}" class="back-link">←戻る</a>
    <h1>プロフィール変更</h1>
    
    <!-- CSS の適用 -->
    <link rel="stylesheet" href="{{ asset('css/user_profile.css') }}">

    <!-- 成功メッセージ表示 -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- プロフィール画像 -->
    <div class="profile-image-section">
        @if ($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" 
                alt="プロフィール画像" 
                class="profile-image">
        @else
            <img src="{{ asset('images/default_profile.png') }}" 
                alt="デフォルト画像" 
                class="profile-image">
        @endif

        <div class="profile-image-text">
            <label for="profile_image" class="profile-image-label">プロフィール画像</label>
            <label class="custom-file-upload">
                ファイルを選択
                <input id="profile_image" type="file" name="profile_image">
            </label>
            @error('profile_image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- ユーザーネーム -->
    <div class="form-group">
        <label>ユーザーネーム</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <!-- カナ -->
    <div class="form-group">
        <label>カナ</label>
        <input type="text" name="name_kana" value="{{ old('name_kana') }}">
        @error('name_kana')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <!-- メールアドレス -->
    <div class="form-group">
        <label>メールアドレス</label>
        <input type="text" name="email" value="{{ old('email') }}">

        @error('email')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <!-- パスワード変更 -->
    <div class="form-group">
        <label>パスワード</label>
        <a href="{{ route('user.password.change') }}" class="change-password-btn">パスワードを変更する</a>
    </div>

    <button type="submit" class="save-button">登録</button>
</form>

</div>
@endsection
