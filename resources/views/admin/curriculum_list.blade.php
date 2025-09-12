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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <button onclick="history.back()" class="col-1 btn btn-secondary btn-sm">← 戻る</button>
            <h1 class="my-4">授業一覧</h1>
            <a href="{{ route('admin.curriculum.create')}}" class="col-1 btn btn-success btn-sm my-3">新規登録</a>
        </div>
        <div class="row d-flex">
            <aside class="col-2">
                @foreach ($grades as $grade)
                    @php
                    $btnClass = match(true) {
                        str_contains($grade->name, '小学校') => 'btn-primary',
                        str_contains($grade->name, '中学校') => 'btn-info',
                        str_contains($grade->name, '高校') => 'btn-secondary',
                        default => 'btn-light',
                    };
                    @endphp
                    <button 
                        class="btn {{ $btnClass }} btn-sm my-2 w-100 grade-btn" 
                        data-grade-id="{{ $grade->id }}">
                        {{ $grade->name }}
                    </button>
                @endforeach
            </aside>
            <main class="col-10">
                <h2 id="selected-grade-name">{{ $selectedGrade?->name ?? '学年が選択されていません' }}</h2>
                <div id="curriculum-container" class="card-container row g-4">
                    @foreach ($curriculums as $curriculum)
                        @include('partials.curriculum_card', ['curriculum' => $curriculum])
                    @endforeach
                </div>
            </main>
            
            <script>
                $(document).ready(function() {
                    $('.grade-btn').on('click', function() {
                        const gradeId = $(this).data('grade-id');
                        
                        $.ajax({
                            url: '{{ route('admin.curriculum.ajax', '') }}/' + gradeId,
                            method: 'GET',
                            success: function(response) {
                                $('#selected-grade-name').text(response.selectedGrade.name);
                                $('#curriculum-container').empty();
                                
                                response.curriculums.forEach(curriculum => {
                                    let deliveryTimes = curriculum.delivery_times.map(time => `
                                        <div class="text-center fs-5">
                                            ${new Date(time.delivery_from).toLocaleDateString()} 
                                            ${new Date(time.delivery_from).toLocaleTimeString()} 〜 
                                            ${new Date(time.delivery_to).toLocaleTimeString()}
                                        </div>
                                    `).join('');
                                    
                                    $('#curriculum-container').append(`
                                        <div class="col-md-4">
                                            <div class="card">
                                                <img src="${curriculum.thumbnail ? '/storage/' + curriculum.thumbnail : 'https://placehold.jp/150x150.png'}" 
                                                    class="card-img-top" alt="サムネイル" width="150" height="150">
                                                <div class="card-body">
                                                    <h5 class="card-title">${curriculum.title}</h5>
                                                    <div class="card-text" style="height: 120px; overflow-y: scroll;">
                                                        ${deliveryTimes}
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row g-2">
                                                            <a href="/admin/curriculum/edit/${curriculum.id}" class="col-5 btn btn-success btn-sm">授業内容編集</a>
                                                            <a href="/admin/delivery/edit/${curriculum.id}" class="col-5 btn btn-success btn-sm mx-2">配信日時編集</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `);
                                });
                            },
                            error: function(error) {
                                console.error('エラー:', error);
                                alert('データの取得に失敗しました');
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</body>
<footer>
</footer>
</html>