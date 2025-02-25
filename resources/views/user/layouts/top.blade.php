@extends('user.layouts.app')

@section('title', 'ユーザートップページ')

@section('content')
<div class="container">

    <div class="banner-slider">
        <div class="banner-inner">
            @foreach ($banners as $banner)
                    <div class="banner-item" data-index="{{ $loop->index }}">
                        <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                    </div>
            @endforeach
        </div>
    </div>

    <div class="dots">
        @foreach ($banners as $banner)
            <div class="dot"></div>
        @endforeach
    </div>

</div>
<br><br>

<div class="container">
    <h2>お知らせ</h2>
    <div class="info-box">
        <div class="info">
            @foreach ($articles as $article)
            <div class="info-item">
                <div class="info_title">
                {{ $article->posted_date }}
                <a href="{{ route('user.show.article') }}" class="info_link">{{ $article->title }}</a>
            </div>

                <time datetime="{{ $article->date }}">{{ $article->date }}</time>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
