@extends('user.layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('user.top') }}" class="back-link">←戻る</a>
    <link rel="stylesheet" href="{{ asset('css/curriculum_progress.css') }}">

    <div class="user-info">
        <div class="profile-container">
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" class="profile-img">
            <div class="user-details">
                <h2>{{ $user->name }} さんの授業進捗</h2>
                <p>現在の学年: <span class="grade-badge">{{ $user->grade ? $user->grade->name : '学年未設定' }}</span></p>
            </div>
        </div>
    </div>

    <div class="grades-container">
        @foreach ($grades as $grade)
            <div class="grade-section">
                <h2 class="grade-title">{{ $grade->name }}</h2>

                @if ($grade->curriculums->isEmpty())
                    <p>この学年にはカリキュラムがありません。</p>
                @else
                    <ul class="curriculum-list">
                        @php
                            // 受講済みのカリキュラムタイトル一覧を取得（同じ学年内で）
                            $clearedTitles = $user->clearChecks
                                ->where('grade_id', $grade->id)
                                ->where('clear_flg', 1)
                                ->pluck('curriculum.title')
                                ->toArray();
                        @endphp

                        @foreach ($grade->curriculums as $curriculum)
                            @php
                                // 受講済みかどうか
                                $isCleared = $user->clearChecks->where('curriculums_id', $curriculum->id)
                                    ->where('clear_flg', 1)
                                    ->isNotEmpty();

                                // 常時公開かどうか
                                $isAlwaysAvailable = $curriculum->alway_delivery_flg == 1;

                                // 同じ学年内で受講済みタイトルと一致するか
                                $canLinkByTitle = in_array($curriculum->title, $clearedTitles);

                                // **修正: 現在の学年のカリキュラムなら未受講でもリンク可能**
                                $isCurrentUserGrade = $user->grade && $user->grade->id == $grade->id;

                                // **リンク条件: 受講済み、常時公開、同じ学年内の受講済みタイトル、現在の学年のカリキュラム**
                                $canLink = $isCleared || $isAlwaysAvailable || $canLinkByTitle || $isCurrentUserGrade;
                            @endphp

                            <li class="curriculum-item">
                                @if ($canLink)
                                    <a href="{{ route('user.curriculum.delivery', ['curriculum' => $curriculum->id]) }}" class="cleared-link">
                                        @if ($isCleared)
                                            <span class="cleared-label">受講済み</span>
                                        @endif
                                        {{ $curriculum->title }}
                                    </a>
                                @else
                                    @if ($isCleared)
                                        <span class="cleared-label">受講済み</span>
                                    @endif
                                    {{ $curriculum->title }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
