@extends('backend/layouts/master')

@section('title')
Thêm mới Chuyên mục sản phẩm
@endsection

@section('main-content')
<h1>Thêm mới Chuyên mục sản phẩm</h1>

<form name="frmCreate" method="post" action="{{ route('backend.shop_categories.store') }}" enctype="multipart/form-data">
  @csrf
  <div>
    <label for="category_code" class="form-label">Mã chuyên mục</label>
    <input type="text" name="category_code" class="form-control" id="category_code"
      placeholder="Mời nhập mã chuyên mục" value="{{ old('category_code') }}">
  </div>

  <div>
    <label for="category_name" class="form-label">Tên chuyên mục</label>
    <input type="text" name="category_name" class="form-control" id="category_name"
      placeholder="Mời nhập tiêu đề bài viết" value="{{ old('category_name') }}">
  </div>

  <div>
    <label for="description" class="form-label">Nội dung mô tả</label>
    <textarea type="text" name="description" class="form-control" id="description"></textarea>
  </div>

  <div>
    <label>Hình ảnh đại diện</label><br />
    <input type="file" name="image" id="image" />

    <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
    <div class="preview-img-container">
      <img src="{{ asset('assets/images/product-img.png') }}" id="preview-img" width="200px" />
    </div>
  </div>

  <div class="mt-2">
    <a href="{{ route('backend.shop_categories.index') }}" class="btn btn-outline-secondary waves-effect waves-light material-shadow-none">Quay về Danh sách</a>

    <button type="submit" class="btn btn-primary waves-effect waves-light">Lưu</button>
  </div>
</form>
@endsection

@section('custom-js')
<script>
  $(function() {
    // Làm khung xem trước hình ảnh sau khi chọn file
    // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
    const reader = new FileReader();
    const fileInput = document.getElementById("image");
    const img = document.getElementById("preview-img");
    reader.onload = e => {
      img.src = e.target.result;
    }
    fileInput.addEventListener('change', e => {
      const f = e.target.files[0];
      reader.readAsDataURL(f);
    })

    // Khung nhập liệu trực quan CKEDITOR
    ClassicEditor
      .create(document.querySelector('#description'), {});
  });
</script>
@endsection