@extends('backend/layouts/master')

@section('title')
Thêm mới Sản phẩm
@endsection

@section('main-content')
<h1>Thêm mới Sản phẩm</h1>

<form name="frmCreate" method="post" action="{{ route('backend.shop_products.store') }}" enctype="multipart/form-data">
  @csrf
  <div>
    <label for="product_code" class="form-label">Mã sản phẩm</label>
    <input type="text" name="product_code" class="form-control" id="product_code"
      placeholder="Mời nhập mã sản phẩm" value="{{ old('product_code') }}">
  </div>

  <div>
    <label for="product_name" class="form-label">Tên sản phẩm</label>
    <input type="text" name="product_name" class="form-control" id="product_name"
      placeholder="Mời nhập tên sản phẩm" value="{{ old('product_name') }}">
  </div>

  <div>
    <label for="short_description" class="form-label">Nội dung mô tả ngắn</label>
    <textarea type="text" name="short_description" class="form-control" id="short_description">{{ old('short_description') }}</textarea>
  </div>

  <div>
    <label for="description" class="form-label">Nội dung mô tả chi tiết</label>
    <textarea type="text" name="description" class="form-control" id="description">{{ old('description') }}</textarea>
  </div>

  <div>
    <label for="standard_cost" class="form-label">Giá nhập</label>
    <input type="number" name="standard_cost" class="form-control" id="standard_cost"
      placeholder="Mời nhập giá nhập" value="{{ old('standard_cost') }}">
  </div>

  <div>
    <label for="list_price" class="form-label">Giá niêm yết</label>
    <input type="number" name="list_price" class="form-control" id="list_price"
      placeholder="Mời nhập giá niêm yết" value="{{ old('list_price') }}">
  </div>

  <div>
    <label for="quantity_per_unit" class="form-label">Số lượng</label>
    <input type="number" name="quantity_per_unit" class="form-control" id="quantity_per_unit"
      placeholder="Mời nhập giá niêm yết" value="{{ old('quantity_per_unit') }}">
  </div>

  <div class="mt-2">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" role="switch" id="discontinued" name="discontinued" value="1" {{ old('discontinued') == "1" ? 'checked' : '' }}>
      <label class="form-check-label" for="discontinued">Ngưng sử dụng?</label>
    </div>
  </div>
  <div class="mt-2">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ old('is_featured') == "1" ? 'checked' : '' }}>
      <label class="form-check-label" for="is_featured">Là sản phẩm nổi bật?</label>
    </div>
  </div>
  <div class="mt-2">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" role="switch" id="is_new" name="is_new" value="1" {{ old('is_new') == "1" ? 'checked' : '' }}>
      <label class="form-check-label" for="is_new">Là sản phẩm mới?</label>
    </div>
  </div>

  <div class="mt-2">
    <label for="category_id" class="form-label">Thuộc chuyên mục nào?</label>
    <select name="category_id" id="category_id" class="form-control">
      <option value="" selected>Mời bạn chọn chuyên mục</option>
      @foreach($dsCategories as $cat)
        @if(old('category_id') == $cat->id)
          <option value="{{ $cat->id }}" selected>{{ $cat->category_name }}</option>
        @else
          <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
        @endif
      @endforeach
    </select>
  </div>

  <div class="mt-2">
    <label for="supplier_id" class="form-label">Thuộc nhà cung cấp nào?</label>
    <select name="supplier_id" id="supplier_id" class="form-control">
      <option value="" selected>Mời bạn chọn nhà cung cấp</option>
      @foreach($dsSuppliers as $sup)
        @if(old('supplier_id') == $sup->id)
          <option value="{{ $sup->id }}" selected>{{ $sup->supplier_name }}</option>
        @else
          <option value="{{ $sup->id }}">{{ $sup->supplier_name }}</option>
        @endif
      @endforeach
    </select>
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
    <a href="{{ route('backend.shop_products.index') }}" class="btn btn-outline-secondary waves-effect waves-light material-shadow-none">Quay về Danh sách</a>

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

    ClassicEditor
      .create(document.querySelector('#short_description'), {});
  });
</script>
@endsection