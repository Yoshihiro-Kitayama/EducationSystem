@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>管理者情報</h2>
        <div class="info-box">
            <p><strong>ユーザーネーム：</strong> {{ Auth::guard('admin')->user()->name }}</p>
            <p><strong>メールアドレス：</strong> {{ Auth::guard('admin')->user()->email }}</p>
        </div>
    </div>
@endsection
