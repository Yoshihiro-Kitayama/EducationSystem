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
    <div class="container">
        <div class="row">
            <button onclick="history.back()" class="col-1 btn btn-secondary btn-sm">← 戻る</button>
            <h1 class="my-4">授業一覧</h1>
            <a href="{{ route('show.curriculum.create')}}" class="col-1 btn btn-success btn-sm my-3">新規登録</a>
        </div>
        <div class="row">
            <aside class="col-2">
                @foreach ($grades as $grade)
                    <a href="{{ url('/curriculum_list/' . $grade->id) }}" class="btn btn-primary btn-sm">
                        {{ $grade->name }} <!-- 学年名を表示 -->
                    </a>
                @endforeach
            </aside>
            <main class="col-10">
                <h2>{{ $selectedGrade->name }}</h2>
                <div class="card-container row">
                    @foreach ($curriculums as $curriculum) 
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" class="card-img-top" alt="サムネイル">
                            <div class="card-body">
                                <h5 class="card-title">{{ $curriculum->title }}</h5>
                                <p class="card-text">
                                @foreach($curriculum->deliveryTimes as $deliveryTime)
                                    <p>{{ date('m-d H:i', strtotime($deliveryTime->delivery_from)) }} 〜 {{ date('m-d H:i', strtotime($deliveryTime->delivery_to)) }}</p>
                                @endforeach</p>
                                <div class="row">
                                    <a href="{{ route('show.curriculum.edit', $curriculum->id) }}" class="col-5 btn btn-success btn-sm">授業内容編集</a>
                                    <a href="{{ route('delivery.edit', $curriculum->id) }}" class="col-5 btn btn-success btn-sm">配信日時編集</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
</body>
<footer>
</footer>
</html>