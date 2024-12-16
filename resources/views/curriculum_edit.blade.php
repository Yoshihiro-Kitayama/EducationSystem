<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CurriculumEdit</title>
    <!-- BootstrapのCSS読み込み
    <link href="css/bootstrap.min.css" rel="stylesheet" /> -->

    <!-- BootstrapのCDNでのCSS読み込み -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <a href="{{ route('show.curriculum.list', ['grade_id' => $grade_id ?? null]) }}" class="col-1 btn btn-secondary btn-sm">← 戻る</a>
            <h2 class="my-3">授業設定</h2>
        </div>
        <main class="row">
            <form action="{{ route('curriculum.update', ['grade_id' => $grade_id]) }}" method="POST" enctype="multipart/form-data" >
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger row">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class>
                    <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" alt="サムネイル画像" width="300">
                    <div class="row"> 
                        <label for="thumbnail">サムネイル</label>
                        <input type="file" name="thumbnail" id="thumbnail">
                    </div>
                </div>
    
                <div class="grade-id row align-items-center justify-content-center mb-3">
                    <label for="grade_id" class="col-2">学年</label>
                    <select name="grade_id" id="grade_id" class="col-4">
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}" {{ $curriculum->grade_id == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="title row align-items-center justify-content-center mb-3">
                    <label for="title" class="col-2">授業名</label>
                    <input type="text" name="title" id="title" value="{{ $curriculum->title }}" required class="col-4">
                </div>
                <div class="video-url row align-items-center justify-content-center mb-3">
                    <label for="video_url" class="col-2">動画URL</label>
                    <input type="text" name="video_url" id="video_url" value="{{ $curriculum->video_url }}" class="col-4">          
                </div>
                <div class="description row align-items-center justify-content-center mb-3">
                    <label for="description" class="col-2">授業概要</label>
                    <textarea name="description" id="description" class="col-4">{{ $curriculum->description }}</textarea>
                </div>
                <div class="alway-delivery-flg row align-items-center justify-content-center mb-3">
                    <input type="checkbox" class="col-2" name="alway_delivery_flg" id="alway_delivery_flg" value="1" {{ old('alway_delivery_flg', 0) ? 'checked' : '' }}>
                    <label for="alway_delivery_flg" class="col-4">常時公開</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">登録</button>
                </div>
            </form>
        </main>
    </div>
</body>
<footer>
</footer>
</html>