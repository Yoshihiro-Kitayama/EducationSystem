{

// バナー画像の切り替え

    document.addEventListener('DOMContentLoaded', function() {
    const bannerInner = document.querySelector('.banner-inner');
    const bannerItems = document.querySelectorAll('.banner-item');
    const dots = document.querySelectorAll('.dot');
    let dotNumber = 0;

    dots[0].classList.add('active');

        // 各ドットをクリックしたときの処理
        dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            // 例：２つ目のdotをクリックするとindex=2となる
            dotNumber = index;
            updateSlider();
        });
        });

        // スライダーの更新処理
        function updateSlider() {
          // バナーの位置を100%ずらせばOK
        const nextBanner = -dotNumber * 100 + '%';
        // バナー画像のスタイルを水平方向に100%スライド
        bannerInner.style.transform = 'translateX(' + nextBanner + ')';

          // ドットのアクティブ状態を更新
        //　選択されているドットの色が濃くなる
        dots.forEach((dot, index) => {
            if (index === dotNumber) {
            dot.classList.add('active');
            } else {
            dot.classList.remove('active');
            }
        });
    }

    });



// クリアフラグ↓


document.addEventListener('DOMContentLoaded', () => {
    const completedBtn = document.getElementById('completed-btn');
    const messageContainer = document.getElementById('message-container');

    if (completedBtn) {
        completedBtn.addEventListener('click', () => {
            const curriculumId = completedBtn.dataset.curriculumId;

            $.ajax({
                url: '/user/update-progress',
                type: 'POST',
                dataType: 'json',
                data: {
                    curriculum_id: curriculumId,
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                success: function(data) {
                    // ボタンのレイアウト変更の部分↓
                    if (data.success) {
                        completedBtn.style.backgroundColor = 'gray';
                        completedBtn.textContent = '受講済み';
                        completedBtn.disabled = true;
                        alert('受講しました');
                    } else {
                        messageContainer.innerHTML = '<div class="alert alert-danger">エラーが発生しました。</div>';
                        console.error(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    messageContainer.innerHTML = '<div class="alert alert-danger">エラーが発生しました。</div>';
                    console.error(status, error);
                }
            });

        });
    }
});





}