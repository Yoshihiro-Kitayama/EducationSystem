@extends('user.layouts.app')

@section('content')
    <div class="top-container">
        <h1>ようこそ、ユーザー専用ページへ！</h1>
        <a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endsection
