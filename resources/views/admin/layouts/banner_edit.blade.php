@extends('admin.layouts.app')

@section('title','バナー管理画面')

@section('content')
  <div class="banner_edit">
    <a class="admin_banner_back" href="{{ route('admin.show.top') }}">←戻る</a>
    <div class="admin_banner_edit_title">バナー管理</div>
    <div class="row">
       <form action="{{ route('admin.show.banner.submit') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        @foreach ($banners as $banner)
        <div id="admin_banner_container">
          <div class="admin_banner_images" id="admin_banner_images-{{ $banner->id }}">
            <img class="admin_banner_images_preview" id="admin_banner_images_preview-{{ $banner->id }}" src="{{ asset($banner->image) }}" alt="バナー画像">
            <div class="banner_edit_form-group">
              <label class="admin_banner_update_form_label" for="admin_banner_update_image_{{ $banner->id }}">ファイルを選択</label>
              <input type="file" class="admin_banner_form" name="banner_update_image[{{ $banner->id }}]" id="admin_banner_update_image_{{ $banner->id }}" data-preview="admin_banner_images_preview-{{ $banner->id }}" value="{{ old('image') }}">
              @if($errors->has('image'))
                <p>{{ $errors->first('image') }}</p>
              @endif
            </div>
              <button type="button" class="admin_banner_destroy" data-banner-id="{{ $banner->id }}" id="admin_banner_destroy_image">
                  <div class="admin_destroy_btn_bar"></div>
              </button>
          </div>
        </div>
        @endforeach
        <div class="no-entry-sign">
          <div class="no-entry-bar"></div>
        </div>
        <div class="banner_edit_form-group_add">
          <div id="admin_banner_edit_form-group_add"></div>
          <button type="button" class="admin_banner_edit_form-group_add_btn" id="admin_banner_edit_form-group_add_btn">
            <div class="admin_banner_edit_form-group_add_btn_bar"></div>
            <div class="admin_banner_edit_form-group_add_btn_vertical"></div>
          </button> 
          
        </div>
        <button type="submit" class="admin_banner_submit">登録</button>
      </form>
    </div>
  </div>
<script src="{{ asset('js/admin_banner_edit.js') }}"></script>
@endsection
