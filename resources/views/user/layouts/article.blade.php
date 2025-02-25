@extends('user.layouts.app')

@section('title', 'お知らせ')

@section('content')


<div>
    <a href="{{ route('user.show.top') }}" class="back-top">←戻る</a>
</div>

<br>
<br>

<div>
    <h1 class="test">
        お知らせ内容
    </h1>
</div>


@endsection
