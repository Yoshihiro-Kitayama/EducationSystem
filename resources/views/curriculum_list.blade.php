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
</head>
<body>
    <div class="container">
        <div class="row">
            <button onclick="history.back()" class="col-1 btn btn-secondary btn-sm">← 戻る</button>
            <h1 class="my-4">授業一覧</h1>
            <a href="{{ route('show.curriculum.create')}}" class="col-1 btn btn-success btn-sm my-3">新規登録</a>
        </div>
        <div class="row d-flex">
            <aside class="col-2">
                @foreach ($grades as $grade)
                    @php
                    // 学年名に応じて色を決める
                    $btnClass = match(true) {
                        str_contains($grade->name, '小学校') => 'btn-primary', // 小学校を含む場合
                        str_contains($grade->name, '中学校') => 'btn-info', // 中学校を含む場合
                        str_contains($grade->name, '高校') => 'btn-secondary', // 高校を含む場合
                        default => 'btn-light', // それ以外
                    };
                    @endphp
                    <a href="{{ url('/curriculum_list/' . $grade->id) }}" class="btn {{ $btnClass }} btn-sm my-2 w-100">
                        {{ $grade->name }}
                    </a>
                @endforeach
            </aside>
            <main class="col-10">
                <h2>{{ $selectedGrade->name }}</h2>
                <div class="card-container row g-4">
                    @foreach ($curriculums as $curriculum) 
                        <div class="col-md-4">
                            <div class="card">
                                <img 
                                src="{{ $curriculum->thumbnail ? asset('storage/' . $curriculum->thumbnail) : 'https://placehold.jp/150x150.png' }}" 
                                class="card-img-top" 
                                alt="サムネイル"
                                width="150"
                                height="150">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $curriculum->title }}</h5>
                                    <div class="card-text justify-content-center" style="height: 120px; overflow-y: scroll;">
                                        @foreach($curriculum->deliveryTimes as $deliveryTime)
                                            <div class="text-center fs-5">{{ date('m月d日', strtotime($deliveryTime->delivery_from)) }}　{{ date('H:i', strtotime($deliveryTime->delivery_from)) }} 〜 {{ date('H:i', strtotime($deliveryTime->delivery_to)) }}</div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer">
                                        <div class="row g-2">
                                            <a href="{{ route('show.curriculum.edit', $curriculum->id) }}" class="col-5 btn btn-success btn-sm">授業内容編集</a>
                                            <a href="{{ route('delivery.edit', $curriculum->id) }}" class="col-5 btn btn-success btn-sm mx-2">配信日時編集</a>
                                        </div>
                                    </div>
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