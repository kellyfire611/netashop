@extends('backend/layouts/master')

@section('title')
Thêm mới cấu hình
@endsection

@section('main-content')
<!-- start page title -->
<div class="row">
  <div class="col-12">
    <div
      class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
      <h4 class="mb-sm-0">Thêm mới Cấu hình</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item">
            <a href="{{ route('backend.shop_settings.index') }}">Danh sách</a>
          </li>
          <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
      </div>

    </div>
  </div>
</div>
<!-- end page title -->

<!-- Form nhập liệu - START -->
<div class="card">
  <div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">Form nhập liệu</h4>
  </div><!-- end card header -->
  <div class="card-body">
    <!-- Hiển thị thông báo lỗi -->
    @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form name="frmCreate" id="frmCreate" method="post" action="{{ route('backend.shop_settings.store') }}">
      @csrf
      <div>
        <label for="group" class="form-label">Tên nhóm</label>
        <input type="text" name="group" class="form-control" id="group"
          placeholder="Mời nhập tên nhóm" value="{{ old('group') }}">
      </div>

      <div class="row">
        <div class="col-6">
          <div>
            <label for="key" class="form-label">Từ khóa</label>
            <input type="text" name="key" class="form-control" id="key"
              placeholder="Mời nhập key">
          </div>
        </div>
        <div class="col-6">
          <div>
            <label for="value" class="form-label">Giá trị</label>
            <input type="text" name="value" class="form-control" id="value"
              placeholder="Mời nhập giá trị">
          </div>
        </div>
      </div>

      <div>
        <label for="description" class="form-label">Diễn giải</label>
        <textarea name="description"
          class="form-control ckeditor-classic" id="description" placeholder="Mời nhập diễn giải"></textarea>

      </div>

      <div class="mt-2">
        <a href="{{ route('backend.shop_settings.index') }}" class="btn btn-outline-secondary waves-effect waves-light material-shadow-none">Quay về Danh sách</a>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Lưu</button>
      </div>
    </form>
  </div>
</div>
<!-- Form nhập liệu - END -->
@endsection

@section('custom-js')
<script>
  $(function() {
    // $('#frmCreate').validate({
    //   rules: {
    //     group: {
    //       required: true,
    //       minlength: 3,
    //       maxlength: 50
    //     },
    //     key: {
    //       required: true,
    //       minlength: 5
    //     }
    //   },
    //   messages: {
    //     group: {
    //       required: 'Vui lòng nhập tên nhóm.',
    //       minlength: 'Tên nhóm phải từ 3 ký tự trở lên.',
    //       maxlength: 'Tên nhóm phải có ít hơn 50 ký tự.'
    //     },
    //     key: {
    //       required: 'Vui lòng nhập từ khóa.',
    //       minlength: 'Từ khóa phải từ 5 ký tự trở lên.',
    //     },
    //   },
    //   errorElement: "em",
    //   errorPlacement: function(error, element) {
    //     // Thêm class `invalid-feedback` cho field đang có lỗi
    //     error.addClass("invalid-feedback");
    //     if (element.prop("type") === "checkbox") {
    //       error.insertAfter(element.parent("label"));
    //     } else {
    //       error.insertAfter(element);
    //     }
    //     // Thêm icon "Kiểm tra không Hợp lệ"
    //     if (!element.next("span")[0]) {
    //       $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>")
    //         .insertAfter(element);
    //     }
    //   },
    //   success: function(label, element) {
    //     // Thêm icon "Kiểm tra Hợp lệ"
    //     if (!$(element).next("span")[0]) {
    //       $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>")
    //         .insertAfter($(element));
    //     }
    //   },
    //   highlight: function(element, errorClass, validClass) {
    //     $(element).addClass("is-invalid").removeClass("is-valid");
    //   },
    //   unhighlight: function(element, errorClass, validClass) {
    //     $(element).addClass("is-valid").removeClass("is-invalid");
    //   }
    // });
  });
</script>
@endsection