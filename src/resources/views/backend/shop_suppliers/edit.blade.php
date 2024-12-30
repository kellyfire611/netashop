@extends('backend/layouts/master')

@section('title')
Cập nhật Nhà cung cấp
@endsection

@section('main-content')
<h1>Cập nhật Nhà cung cấp</h1>

<form name="frmUpdate" method="post" action="{{ route('backend.shop_suppliers.update', ['id' => $updatingModel->id]) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div>
    <label for="supplier_code" class="form-label">Mã nhà cung cấp</label>
    <input type="text" name="supplier_code" class="form-control" id="supplier_code"
      placeholder="Mời nhập mã nhà cung cấp" 
      value="{{ old('supplier_code', $updatingModel->supplier_code) }}">
  </div>

  <div>
    <label for="supplier_name" class="form-label">Tên nhà cung cấp</label>
    <input type="text" name="supplier_name" class="form-control" id="supplier_name"
      placeholder="Mời nhập tên nhà cung cấp" 
      value="{{ old('supplier_name', $updatingModel->supplier_name) }}">
  </div>

  <div>
    <label for="description" class="form-label">Nội dung mô tả</label>
    <textarea type="text" name="description" class="form-control" id="description">{{ old('description', $updatingModel->description) }}</textarea>
  </div>

  <div>
    <label>Hình ảnh đại diện</label><br />
    <input type="file" name="image" id="image" />

    <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
    <div class="preview-img-container">
      @if(empty($updatingModel->image))
        <img src="{{ asset('assets/images/product-img.png') }}" id="preview-img" width="200px" />
      @else
        <img src="/storage/uploads/{{ $updatingModel->image }}" id="preview-img" width="200px" />
      @endif
    </div>
  </div>

  <div class="mt-2">
    <a href="{{ route('backend.shop_suppliers.index') }}" class="btn btn-outline-secondary waves-effect waves-light material-shadow-none">Quay về Danh sách</a>

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