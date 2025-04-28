@extends('user.layouts.app')

@section('title', 'プロフィール設定')

@section('content')


<div>
    <a href="{{ route('user.show.top') }}" class="back-top">←戻る</a>
</div>

<br>
<br>

<div>
    <h1 class="test">
        プロフィール設定ページ
    </h1>
</div>


@endsection
