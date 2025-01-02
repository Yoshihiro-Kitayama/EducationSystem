@extends('user.layouts.app')

@section('title','ユーザー授業一覧')

@section('content')
<div class="header_sidebar_main_container">
    <!-- 授業一覧のヘッダー表示 -->
    <div>@include('user.layouts.curriculum_list_header')</div>
    <div class="sidebar_main_container">
        <!-- サイドバー表示 -->
        <div> @include('user.layouts.curriculum_list_sidebar')</div>
        <!-- メインコンテンツ表示 -->
        <div class="main-contents">
            <div class="curriculums_list_box" id="curriculum-container">
                @foreach($curriculums as $curriculum) 
                <div class="curriculum_box">
                    @if ($curriculum->thumbnail== null)
                        <img src="{{ asset('images/thumbnail/no_image.jpg') }}" alt="サムネイル画像">
                    @else
                        <img src="{{ asset('images/thumbnail/'.$curriculum->thumbnail) }}" alt="サムネイル画像">
                    @endif

                    <div class="curriculum_title"> {{ $curriculum->title }}</div>
                    <div> 
                        @if($curriculum->alway_delivery_flg == 1)
                            <div class="curriculum_delivery_on">常時公開中</div>
                        @elseif (isset($getAdjustedDeliveryTimes[$curriculum->id]))
                        @foreach ($getAdjustedDeliveryTimes[$curriculum->id] as $day => $times)
                                @foreach ($times as $index => $time)
                                    <div class="curriculum_delivery_from_to">
                                        <div class="curriculum_delivery_days">
                                            @if ($index === 0)
                                                {{ $day }}
                                            @else
                                                &nbsp; <!-- 2行目以降は空白を表示 -->
                                            @endif
                                        </div>
                                        <div class="curriculum_delivery_time">
                                            {{ $time['from_time'] }} ~ {{ $time['to_time'] }}
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div> 
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/curriculum_list.js') }}"></script>
@endsection
