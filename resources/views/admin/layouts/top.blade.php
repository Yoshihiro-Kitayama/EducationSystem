@extends('admin.layouts.app')

@section('title', 'トップページ')

@section('content')
<div class="admin_top">
  <div class="admin_top_box">
    @auth('admin')
      <div class="admin_top_name">ユーザーネーム：{{ $admin->name }}</div>
      <div class="admin_top_email">メールアドレス：{{ $admin->email }}</div>
    @else
      <div class="admin_top_name">ユーザーネーム：ログインしていません。</div>
      <div class="admin_top_email">メールアドレス：ログインしていません。</div>
    @endif
  </div>
</div>
@endsection