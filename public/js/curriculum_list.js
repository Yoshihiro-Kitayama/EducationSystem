//ページをロード時に実行
$(document).ready(function () {
  // 表示月を変更するヘッダーのナビゲーションのコード
  $.ajax({
    url: 'curriculum_list',
    type:'GET',
    dataType:'json',
    success: function (data) {
      //ヘッダーの月表示
      console.log("取得したデータ:",data);
      const formattedMonth = formatMonth(data.current_month);
      $('#current_year_month').text(formattedMonth);
      
      if (data.curriculum_clear_data){
        toggleButton(data.curriculum_clear_data);
      }else{
        console.error("カリキュラムのクリアデータが存在しません");
      }
    },
    error: function (xhr, status, error){
      console.error("AJAX エラー:", error);
    }
    
  });

 });

//ボタンの活性化非活性化のコード
  function toggleButton(curriculum_clear_data){
    const currentGradeId = curriculum_clear_data.current_grade_id;
    const userClearFlgs = curriculum_clear_data.user_clear_flgs;
    console.log("currentGradeId:", currentGradeId);
    console.log("userClearFlgs:", userClearFlgs);
    const buttons = document.querySelectorAll('[class^="grade-button-"]');
    console.log("取得したボタン要素:", buttons);

    document.querySelectorAll('[class^="grade-button-"]').forEach(button => {
      const gradeId = Number(button.id.split('-').pop());
      console.log("gradeId:", gradeId);
      //ボタンの活性化処理
      if (gradeId === currentGradeId || userClearFlgs.includes(gradeId)){
        button.disabled = false;
      }else{
        button.disabled = true;
      }
      })
    };
  
  

// 月を取得するコード
function formatMonth(current_month) {
  try{
  const date = new Date(current_month);
  const year = date.getFullYear();
  const month = date.getMonth() + 1;
  return `${year}年${month}月スケジュール`;
  }catch(error){
    console.error('Date format error:', error);
    return '日付形式が不正です。';

  }
}
// 学年を変更するコード
$(document).on('click','[id^="grade-change-button-"]',function(){
  event.preventDefault(); 

  const clickGradeButton = $(this);
  const buttonId = clickGradeButton.attr('id');
  const gradeId = buttonId.split('-').pop();
  console.log('クリックされたボタンID:', gradeId);

  $.ajax({
    url: 'curriculum_list',
    type:'GET',
    data:{ grade_id: gradeId},
    dataType:'json',
    success:function(data) {
      console.log("取得したデータ",data);
      updateCurriculumList(data);
    },
    error: function(xhr, status, error){
      console.error("エラーが発生しました:", error);
    }
  })
});


// 先月来月を移動するコード
$(document).on('click','#curriculum_prev-button, #curriculum_next-button', function(data){
  const route = $(this).data('route');
  const gradeId = data.grade_id

  $.ajax({
    url: route,
    type:'GET',
    data:{ grade_id: gradeId},
    dataType:'json',
    success: function (data) {
      console.log("取得したデータ:", data);
      console.log("curriculumのデータ", data.curriculums)
      updateCurriculumList(data);
      },
      error: function(xhr, status, error){
        console.error("エラーが発生しました:", error);
      }
  });
});

// カリキュラムリストを更新するコード
function updateCurriculumList(data){
 let curriculumListHtml = '';

      // 以下カリキュラムリストを生成
      data.curriculums.forEach(curriculum => {
        // 以下サムネイルを生成
        let thumbnail = curriculum.thumbnail
          ? `/images/thumbnail/${curriculum.thumbnail}`
          : `/images/thumbnail/no_image.jpg`;

        // 配信期間の生成
        let deliveryHtml = '';
        const deliveryTimes = data.getAdjustedDeliveryTimes[curriculum.id];

        if (curriculum.alway_delivery_flg == 1){
          deliveryHtml = `<div class="curriculum_delivery_on">常時公開中</div>`
        } else if (deliveryTimes){
          for (const [day, times] of Object.entries(deliveryTimes)){
            times.forEach((time, index) => {
              deliveryHtml += `
              <div class="curriculum_delivery_from_to">
                <div class="curriculum_delivery_days">
                  ${index === 0 ? day : '&nbsp;'}
                </div>
                <div class="curriculum_delivery_time">
                   ${time.from_time} ~ ${time.to_time}
                </div>
              </div>
              `;
            });
          }
        }

        //HTMLを生成
        curriculumListHtml += `
            <div class="curriculum_box">
              <img src="${thumbnail}" alt="サムネイル画像">
              <div class="curriculum_title">${curriculum.title}</div>
              <div>${deliveryHtml}</div>
            </div>
          `;
      });
      $('#curriculum-container').html(curriculumListHtml);
      
      $('#curriculum_prev-button').data('route', data.prev_month_route);
      $('#curriculum_next-button').data('route', data.next_month_route);

      //ヘッダーの学年ボタンの色を変えるためのクラス変更
      const curriculumHeaderGrade = document.getElementById('curriculum_header_grade');
      const newGradeColorClass =`curriculum_header_grade_button-${data.grade_color}`;
      curriculumHeaderGrade.className = newGradeColorClass;

      $('#curriculum_header_grade').html(data.grade_name);

      const formattedMonth = formatMonth(data.current_month);
      $('#current_year_month').text(formattedMonth);
      formatMonth(data.current_month);
}

