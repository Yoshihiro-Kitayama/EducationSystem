@extends('user.layouts.app')

@section('title', '配信ページ')

@section('content')

<div>
    <a href="{{ route('user.show.top') }}" class="back-top">←戻る</a>
</div>

<div class="video-box-container">

    <div class="video-box">
        @foreach($curriculums as $curriculum)
        <div class="video">
            <a href="{{ $curriculum->video_url }}" target="_blank">
                <img src="{{ asset($curriculum->thumbnail) }}">
            </a>
        </div>
        @endforeach

    </div>

<div class="completed">
    @if ($curriculum)
        <button id="completed-btn" class="completed-btn" data-curriculum-id="{{ $curriculum->id }}"
            @if ($curriculumProgress && $curriculumProgress->clear_flg == 1)
                disabled style="background-color: gray;"
            @endif>
            {{ $curriculumProgress && $curriculumProgress->clear_flg == 1 ? '受講済み' : '受講しました' }}
        </button>
    @else
        <p>カリキュラムが見つかりません。</p>
    @endif
</div>

</div>


    <div class="grade">
        @foreach($grades as $grade)
        <p>{{ $grade->name }}</p>
        @endforeach
    </div>

    @foreach($curriculums as $curriculum)
    <div class="curriculum-info">
        <div class="curriculum-title">
            {{ $curriculum->title }}
        </div>

        <br>

        <p><strong>講座内容</strong></p>
        <div  class="curriculum-description">
            {{ $curriculum->description }}
        </div>

    </div>
    @endforeach


@endsection
