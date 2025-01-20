$(document).ready(function(){
  let csrfToken = $('meta[name="csrf-token"]').attr('content');
  let newBannerIndex = 0; //追加のボタンで新しいフォームを作成するメソッドで使用

  $(document).on('click', '.admin_banner_destroy', function () {
    let bannerId = $(this).data('banner-id');
    deleteBanner(bannerId);
  });

  function deleteBanner(bannerId) {
    if (!confirm("削除します。よろしいですか？")) {
      return;
    }

    $.ajax({
      url: `banner/delete/${bannerId}`,
      type: 'POST',
      data: {
        _token: csrfToken,
        _method: 'DELETE'
      },
      dataType: 'json',
    })
      .done(function (response) {
        if (response.success) {
          alert("バナーを削除しました。");
          $(`#admin_banner_images-${bannerId}`).remove();
        } else {
          alert("削除に失敗しました。");
        }
      });
  }
  $(document).on('click', '.admin_banner_edit_form-group_add_btn', function () {
      newBannerIndex++;
      const newBannerId = `new_${newBannerIndex}`;
      let adminBannerForm = `
      <div class="banner_edit_form-group_add_form" id="admin_banner_new_images_${newBannerId}">
        <img class="admin_banner_images_preview" id="admin_banner_new_images_preview_${newBannerId}"  >
        <div class="banner_edit_form-group_add">
          <label class="admin_banner_update_form_label" for="admin_banner_update_image_new_${newBannerId}">ファイルを選択</label>
          <input type="file" class="admin_banner_form" name="banner_new_update[]" id="admin_banner_update_image_new_${newBannerId}" data-preview="admin_banner_new_images_preview_${newBannerId}" multiple>
        </div>
      </div>`;
  
      $('#admin_banner_edit_form-group_add').before(adminBannerForm);
  });
  
  $(document).on('change', '.admin_banner_form', function () {
        const previewId = $(this).data('preview');
        const previewImg = document.getElementById(previewId);

        if (this.files && this.files[0]) {
          const file = this.files[0];

          if (!file.type.startsWith('image/')) {
            alert('画像ファイルを選択してください。');
            return;
          }

          const reader = new FileReader();
          reader.onload = function(e) {
            previewImg.src = e.target.result;
          };
          reader.readAsDataURL(file);
        } else {
          previewImg.removeAttribute('src');
        }
  });
});
