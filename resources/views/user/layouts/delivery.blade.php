@extends('user.layouts.app')

@section('title', '配信ページ')

@section('content')

<div>
    <a href="{{ route('user.show.top') }}" class="back-top">←戻る</a>
</div>

<div class="video-box-container">

    <div class="video-box">
        <div class="video">
        @if ($curriculum->alway_delivery_flg == 1 && $deliveryPeriod)
                <div class="video-iframe-container">
                    <iframe src="{{ $curriculum->video_url }}" frameborder="0" class="video-iframe"></iframe>
                </div>

            @else
                <div class="thumbnail-container">
                    <img src="{{ asset($curriculum->thumbnail) }}" class="thumbnail">
                </div>
            @endif

    </div>

    </div>

<div class="completed">
    @if ($curriculum)
            <button id="completed-btn" class="completed-btn" data-curriculum-id="{{ $curriculum->id }}"
                @if ($curriculumProgress && $curriculumProgress->clear_flg == 1 || $curriculum->alway_delivery_flg == 0 || !$deliveryPeriod)
                    disabled style="background-color: gray;"
                @endif>
                {{ $curriculumProgress && $curriculumProgress->clear_flg == 1 ? '受講済み' : '受講しました' }}
            </button>
    @else
        <p>カリキュラムが見つかりません。</p>
    @endif
    </div>
    <div id="message-container"></div>
</div>


    <div class="grade">
        @if ($grade)
        <p>{{ $grade->name }}</p>
        @endif
    </div>

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


@endsection
