<div class="col-md-4">
    <div class="card">
        <img src="{{ $curriculum->thumbnail ? asset('storage/' . $curriculum->thumbnail) : 'https://placehold.jp/150x150.png' }}" 
            class="card-img-top" alt="サムネイル" width="150" height="150">
        <div class="card-body">
            <h5 class="card-title">{{ $curriculum->title }}</h5>
            <div class="card-text" style="height: 120px; overflow-y: scroll;">
                @foreach($curriculum->deliveryTimes as $deliveryTime)
                    <div class="text-center fs-5">
                        {{ date('m月d日', strtotime($deliveryTime->delivery_from)) }}　
                        {{ date('H:i', strtotime($deliveryTime->delivery_from)) }} 〜 
                        {{ date('H:i', strtotime($deliveryTime->delivery_to)) }}
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <div class="row g-2">
                    <a href="{{ route('admin.curriculum.edit', $curriculum->id) }}" class="col-5 btn btn-success btn-sm">授業内容編集</a>
                    <a href="{{ route('admin.delivery.edit', $curriculum->id) }}" class="col-5 btn btn-success btn-sm mx-2">配信日時編集</a>
                </div>
            </div>
        </div>
    </div>
</div>