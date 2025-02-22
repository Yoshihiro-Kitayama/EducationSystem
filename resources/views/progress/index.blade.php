<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>授業進捗</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    @include('user/user_header')

    <div class="container">
        <a href="{{ route('home') }}" class="back-link">&larr; 戻る</a>
        <h1>{{ $user->name }}さんの授業進捗</h1>
        
        <!-- 現在の学年を表示 -->
        <h2>現在の学年: 
    <span class="current-grade-label">
        {{ $user->grade->name ?? '学年未設定' }}
    </span>
       </h2>

        <!-- 学年ごとに表示 -->
        @foreach ($grades as $grade)
            <div class="grade-section">
                <h3 class="grade-title">{{ $grade->name }}</h3>
                <ul class="curriculum-list">
                    @foreach ($grade->curriculums as $curriculum)
                        <li>
                            @php
                                $progress = $progresses->where('curriculum_id', $curriculum->id)->first();
                            @endphp
                            
                            @if ($progress && $progress->clear_flg)
                                <span class="completed">受講済</span>
                            @endif
                            {{ $curriculum->title }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</body>
</html>
