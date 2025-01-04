@extends('backend/layouts/master')

@section('title')
Thêm mới Hình Sản phẩm
@endsection

@section('main-content')
<h1>Thêm mới Hình Sản phẩm</h1>

<form name="frmCreate" class="dropzone" id="frmCreate" method="post" action="{{ route('backend.shop_product_images.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="mt-2">
    <label for="product_id" class="form-label">Thuộc sản phẩm nào?</label>
    <select name="product_id" id="product_id" class="form-control">
      <option value="" selected>Mời bạn chọn sản phẩm</option>
      @foreach($dsProducts as $p)
        @if(old('product_id') == $p->id)
          <option value="{{ $p->id }}" selected>{{ $p->product_name }}</option>
        @else
          <option value="{{ $p->id }}">{{ $p->product_name }}</option>
        @endif
      @endforeach
    </select>
  </div>

  <div>
    <label>Hình ảnh đại diện</label><br />
    <input type="file" name="image" id="image" style="display: none;" />

    <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
    {{-- <div class="preview-img-container">
      <img src="{{ asset('assets/images/product-img.png') }}" id="preview-img" width="200px" />
    </div> --}}
  </div>

  <div class="mt-2">
    <a href="{{ route('backend.shop_product_images.index') }}" class="btn btn-outline-secondary waves-effect waves-light material-shadow-none">Quay về Danh sách</a>
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

    // Init Dropzone
    // Dropzone.autoDiscover = false;
    Dropzone.options.frmCreate = {
      paramName: "image",
      maxFilesize: 5, // MB
      maxFiles: 3,
      acceptedFiles: ".jpeg,.jpg,.png,.gif",
    };
  });
</script>
@endsection