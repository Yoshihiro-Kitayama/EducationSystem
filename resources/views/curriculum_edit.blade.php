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
</head>
<body>
    <a href="{{ route('show.curriculum.list', ['grade_id' => $grade_id ?? null]) }}" class="btn btn-secondary">← 戻る</a>
    <h1>授業設定</h1>
    <main>
        <form action="{{ route('curriculum.update', ['grade_id' => $grade_id]) }}" method="POST" enctype="multipart/form-data">
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
            <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" alt="サムネイル画像" width="100">
            <label for="thumbnail">サムネイル</label>
            <input type="file" name="thumbnail" id="thumbnail"><br>

            <label for="grade_id">学年</label>
            <select name="grade_id" id="grade_id">
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}" {{ $curriculum->grade_id == $grade->id ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select><br>

            <label for="title">授業名</label>
            <input type="text" name="title" id="title" value="{{ $curriculum->title }}" required><br>

            <label for="video_url">動画URL</label>
            <input type="text" name="video_url" id="video_url" value="{{ $curriculum->video_url }}"><br>            
        
            <label for="description">授業概要</label>
            <textarea name="description" id="description">{{ $curriculum->description }}</textarea><br>
        
            <label for="alway_delivery_flg">常時公開</label>
            <input type="checkbox" name="alway_delivery_flg" id="alway_delivery_flg" value="1" {{ old('alway_delivery_flg', 0) ? 'checked' : '' }}><br>
        
            <button type="submit">登録</button>
        </form>
    </main>
</body>
<footer>
</footer>
</html>