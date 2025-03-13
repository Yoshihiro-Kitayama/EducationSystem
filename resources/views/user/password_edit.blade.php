@extends('user.layouts.app')

@section('content')
<div class="password-change-container">
    <a href="{{ route('user.profile.edit') }}" class="back-link">&larr; 戻る</a>
    <h1 class="title">パスワード変更</h1>
    
    <!-- CSSの適用 -->
    <link rel="stylesheet" href="{{ asset('css/user_password_change.css') }}">
    
    @if (session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('user.password.update') }}" method="POST">
    @csrf
    
    <label for="old_password">旧パスワード</label>
    <input type="password" name="old_password" id="old_password">
    @error('old_password')
        <p class="error-message">{{ $message }}</p>
    @enderror

    <label for="new_password">新パスワード</label>
    <input type="password" name="new_password" id="new_password">
    @error('new_password')
        <p class="error-message">{{ $message }}</p>
    @enderror

    <label for="new_password_confirmation">新パスワード確認</label>
    <input type="password" name="new_password_confirmation" id="new_password_confirmation">
    @error('new_password_confirmation')
        <p class="error-message">{{ $message }}</p>
    @enderror

    <button type="submit">登録</button>
</form>

</div>
@endsection
