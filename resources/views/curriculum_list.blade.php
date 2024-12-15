<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CurriculumList</title>
    <!-- BootstrapのCSS読み込み
    <link href="css/bootstrap.min.css" rel="stylesheet" /> -->

    <!-- BootstrapのCDNでのCSS読み込み -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
</head>
<body>
    <header>
        <button onclick="history.back()" class="btn btn-secondary">← 戻る</button>
            <h1>授業一覧</h1>
            <a href="{{ route('show.curriculum.create')}}" class="btn btn-primary">新規登録</a>
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
            @foreach ($curriculums as $curriculum) 
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" class="card-img-top" alt="サムネイル">
                    <div class="card-body">
                        <h5 class="card-title">{{ $curriculum->title }}</h5>
                        <p class="card-text">
                        @foreach($curriculum->deliveryTimes as $deliveryTime)
                            <p>{{ date('m-d H:i', strtotime($deliveryTime->delivery_from)) }} 〜 {{ date('m-d H:i', strtotime($deliveryTime->delivery_to)) }}</p>
                        @endforeach</p>
                        <a href="{{ route('show.curriculum.edit', $curriculum->id) }}" class="btn btn-primary">授業内容編集</a>
                        <a href="{{ route('delivery.edit', $curriculum->id) }}" class="btn btn-primary">配信日時編集</a>
                    </div>
                </div>
            @endforeach
    </main>
</body>
<footer>
</footer>
</html>