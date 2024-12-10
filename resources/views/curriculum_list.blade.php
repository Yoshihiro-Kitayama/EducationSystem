<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CurriculumList</title>
</head>
<body>
    <header>
            <button>←戻る</button>
            <h1>授業一覧</h1>
            <button>新規登録</button>
            <h2>{{ $selectedGrade->name }}</h2>
        </header>
        <aside>
            @foreach ($grades as $grade)
                <a href="{{ url('/curriculum_list/' . $grade->id) }}" class="btn btn-primary">
                    {{ $grade->name }} <!-- 学年名を表示 -->
                </a>
            @endforeach
        </aside>
        <main>
            <h1>{{ $selectedGrade->name }}のカリキュラム一覧</h1>
            <table class="table">
                <tbody>
                    @foreach ($curriculums as $curriculum)
                        <tr>
                            <td>{{ $curriculum->thumbnail }}</td>
                            <td>{{ $curriculum->title }}</td>
                                @foreach($curriculum->deliveryTimes as $deliveryTime)
                                <p>{{ date('m-d H:i', strtotime($deliveryTime->delivery_from)) }} 〜 {{ date('m-d H:i', strtotime($deliveryTime->delivery_to)) }}</p>
                                @endforeach
                        </tr>
                        <a href="{{ route('show.curriculum.edit', $curriculum->id) }}" class="btn btn-primary">授業内容編集</a>
                        <a href="{{ route('delivery.edit', $curriculum->id) }}" class="btn btn-primary">配信日時編集</a>
                    @endforeach
                </tbody>
            </table>
        </main>
</body>
<footer>
</footer>
</html>