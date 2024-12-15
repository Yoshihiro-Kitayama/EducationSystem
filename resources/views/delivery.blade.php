<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery</title>
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
    <a href="{{ route('show.curriculum.list', ['grade_id' => $selectedCurriculum->grade_id]) }}" class="btn btn-secondary">戻る</a>
    <h1>配信日時設定</h1>
    <main>
        <h2>{{ $selectedCurriculum->title }}</h2>
        <form action="{{ route('delivery.update', ['curriculums_id' => $curriculums_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                @foreach($deliveryTimes as $index => $deliveryTime)
                    <div class = "delivery-time-row">
                        <div class="mb-3">
                            <label class="form-label">配信開始日時</label>
                            <input type="datetime-local" name="delivery_times[{{ $index }}][delivery_from]" class="form-control" value="{{ $deliveryTime->delivery_from->format('Y-m-d\TH:i') }}" required>
                        </div>
                        <p>～</p>
                        <div class="mb-3">
                            <label class="form-label">配信終了日時</label>
                            <input type="datetime-local" name="delivery_times[{{ $index }}][delivery_to]" class="form-control" value="{{ $deliveryTime->delivery_to->format('Y-m-d\TH:i') }}" required>
                        </div>
                        <!-- 削除ボタン -->
                        <button type="button" class="btn btn-danger remove-delivery-time">－</button> 
                    </div>
                @endforeach

            <!-- 新しい配信時間の入力フィールド -->
            <div class="mb-3" id="new-delivery-times">
                <button type="button" id="add-delivery-time" class="btn btn-success">＋</button>
            </div>

            <button type="submit" class="btn btn-primary">登録</button>
        </form>
        <script>
           document.getElementById('add-delivery-time').addEventListener('click', function() {
                // 新しい入力フィールドを表示
                const newFields = document.createElement('div');
                arrayNum = document.querySelectorAll(".delivery-time-row").length;
                newFields.classList.add('mb-3');
                newFields.innerHTML = `
                   <div class="delivery-time-row">
                        <div class="mb-3">
                            <label for="new_delivery_from" class="form-label">配信開始日時</label>
                            <input type="datetime-local" name="delivery_times[`+arrayNum+`][delivery_from]" class="form-control" required>
                        </div>
                        <p>～</p>
                        <div class="mb-3">
                            <label for="new_delivery_to" class="form-label">配信終了日時</label>
                            <input type="datetime-local" name="delivery_times[`+arrayNum+`][delivery_to]" class="form-control" required>
                        </div>
                    </div>
                `;
                document.getElementById('new-delivery-times').appendChild(newFields);
                // 新しく追加された削除ボタンにイベントリスナーを追加
                    addRemoveEvent(newFields.querySelector('.remove-delivery-time'));
                });

                // 削除ボタンの処理を追加
                function addRemoveEvent(button) {
                    button.addEventListener('click', function () {
                        this.closest('.delivery-time-row').remove();
                    });
                }

                // 初期の削除ボタンにもイベントリスナーを追加
                document.querySelectorAll('.remove-delivery-time').forEach(addRemoveEvent);
                            
                        
        </script>
        
    </main>
</body>
<footer>
</footer>
</html>