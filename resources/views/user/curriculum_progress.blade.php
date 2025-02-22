@extends('user.layouts.app')

@section('content')
<div class="container">
    <link rel="stylesheet" href="{{ asset('css/curriculum_progress.css') }}">

    <div class="user-info">
        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" class="profile-img">
        <div class="user-details">
            <h2>{{ $user->name }} さんの授業進捗</h2>
            <p>現在の学年: <span class="grade-badge">{{ $user->grade ? $user->grade->name : '学年未設定' }}</span></p>
        </div>
    </div>

    <h1 class="mb-4">授業進捗</h1>

    <div class="grades-container">
        @foreach ($grades as $grade)
            <div class="grade-section">
                <h2 class="grade-title">{{ $grade->name }}</h2>
                @if ($grade->curriculums->isEmpty())
                    <p>この学年にはカリキュラムがありません。</p>
                @else
                    <ul class="curriculum-list">
                        @foreach ($grade->curriculums as $curriculum)
                            @php
                                $isCleared = $user->clearChecks()
                                    ->where('grade_id', $grade->id)
                                    ->where('clear_flg', 1)
                                    ->exists();
                            @endphp
                            <li class="curriculum-item">
                                @if ($isCleared)
                                    <span class="cleared">受講済み</span>
                                @endif
                                {{ $curriculum->title }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
