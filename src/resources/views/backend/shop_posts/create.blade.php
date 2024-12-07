@extends('backend/layouts/master')

@section('title')
Thêm mới bài viết
@endsection

@section('main-content')
<h1>Thêm mới bài viết</h1>

<form name="frmCreate" method="post" action="{{ route('backend.shop_posts.store') }}" enctype="multipart/form-data">
  @csrf
  <div>
    <label for="post_slug" class="form-label">Địa chỉ bài viết</label>
    <input type="text" name="post_slug" class="form-control" id="post_slug"
      placeholder="Mời nhập địa chỉ bài viết" value="{{ old('post_slug') }}">
  </div>

  <div>
    <label for="post_title" class="form-label">Tiêu đề bài viết</label>
    <input type="text" name="post_title" class="form-control" id="post_title"
      placeholder="Mời nhập tiêu đề bài viết" value="{{ old('post_title') }}">
  </div>

  <div>
    <label for="post_content" class="form-label">Nội dung bài viết</label>
    <textarea type="text" name="post_content" class="form-control" id="post_content"></textarea>
  </div>

  <div>
    <label for="post_excerpt" class="form-label">Tóm tắt bài viết</label>
    <textarea type="text" name="post_excerpt" class="form-control" id="post_excerpt"></textarea>
  </div>

  <div class="row">
    <div class="col-6">
      <div>
        <label>Loại bài viết</label>
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="post_type" id="post_type_1" value="post" checked>
          <label class="form-check-label" for="post_type_1">
            Bài viết (post)
          </label>
        </div>

        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="post_type" id="post_type_2" value="page">
          <label class="form-check-label" for="post_type_2">
            Trang tĩnh (page)
          </label>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div>
        <label>Trạng thái bài viết</label>
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="post_status" id="post_status_1" value="draft" checked>
          <label class="form-check-label" for="post_status_1">
            Bản nháp (draft)
          </label>
        </div>

        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="post_status" id="post_status_2" value="publish">
          <label class="form-check-label" for="post_status_2">
            Công bố (publish)
          </label>
        </div>
      </div>
    </div>
  </div>

  <div>
    <label>Hình ảnh đại diện</label><br />
    <input type="file" name="post_image" />
  </div>

  <div>
    <label>Tác giả</label>
    <select name="user_id" class="form-control">
      @foreach($lstUsers as $u)
      <option value="{{ $u->id }}">
        {{ $u->last_name }} {{ $u->first_name }}
      </option>
      @endforeach
    </select>
  </div>

  <div>
    <label>Chuyên mục bài viết</label>
    <select name="post_category_id" class="form-control">
      @foreach($lstPostCaterories as $cat)
      <option value="{{ $cat->id }}">
        {{ $cat->post_category_name }}
      </option>
      @endforeach
    </select>
  </div>

  <div class="mt-2">
    <a href="{{ route('backend.shop_posts.index') }}" class="btn btn-outline-secondary waves-effect waves-light material-shadow-none">Quay về Danh sách</a>

    <button type="submit" class="btn btn-primary waves-effect waves-light">Lưu</button>
  </div>
</form>
@endsection

@section('custom-js')
<script>
  $(function() {
    ClassicEditor
      .create(document.querySelector('#post_content'), {});
    ClassicEditor
      .create(document.querySelector('#post_excerpt'), {});
  });
</script>
@endsection