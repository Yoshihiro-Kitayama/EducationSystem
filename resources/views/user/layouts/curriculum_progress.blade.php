@extends('user.layouts.app')

@section('title', '授業進捗')

@section('content')


<div>
    <a href="{{ route('user.show.top') }}" class="back-top">←戻る</a>
</div>

<br>
<br>

<div>
    <h1 class="test">
        授業進捗ページ
    </h1>
</div>


@endsection
