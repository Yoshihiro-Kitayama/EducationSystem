@extends('user.layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('user.progress.index') }}" class="back-link">← 授業進捗に戻る</a>
    
    <h1 class="mb-4">配信ページ</h1>

    <div class="curriculum-detail">
        <h2>{{ $curriculum->title }}</h2>
    </div>
</div>
@endsection
