@extends('backend/layouts/master')

@section('title')
  Danh sách Hình Sản phẩm
@endsection

@section('main-content')
  <h1>Danh sách Hình Sản phẩm</h1>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Khung tìm kiếm</h5>
      <form name="frmSearch" method="GET" action="{{ route('backend.shop_product_images.search') }}">
        <div class="row">
          <div class="col-6">
            <label for="keyword_image">Tên hình</label>
            <input type="text" name="keyword_image" id="keyword_image" placeholder="Nhập từ khóa tìm kiếm theo tên hình" class="form-control" value="{{ request()->keyword_image }}" />
          </div>
          <div class="col-6">
            <label for="keyword_product_name">Tên sản phẩm</label>
            <input type="text" name="keyword_product_name" id="keyword_product_name"
              placeholder="Nhập từ khóa tìm kiếm theo tên sản phẩm" class="form-control"
              value="{{ request()->keyword_product_name }}" />
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-12">
            <button type="submit" class="btn btn-primary float-end">Tìm kiếm</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <hr />
  Số lượng dữ liệu: {{ count($dsProductImages) }}
  <br />
  <a class="btn btn-primary" href="{{ route('backend.shop_product_images.create') }}">Thêm</a>
  <a class="btn btn-danger" id="btnBatchDelete" href="#"
    data-batch-delete-url="{{ route('backend.shop_product_images.batchDelete') }}">Xóa hàng loạt</a>
  <table class="table table-bordered">
    <tr>
      <th>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" id="checkAll">
        </div>
        Chọn
      </th>
      <th>Id</th>
      <th>Sản phẩm</th>
      <th>Ảnh</th>
      <th>Hành động</th>
    </tr>
    @foreach ($dsProductImages as $index => $img)
      <tr>
        <td>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $img->id }}" name="listSelectedIds[]"
              id="listSelectedIds_{{ $index + 1 }}">
          </div>
        </td>
        <td>{{ $img->id }}</td>
        <td>
          <b>CM: {{ $img->product->category->category_name }}</b><br />
          <b>NCC: {{ $img->product->supplier->supplier_name }}</b><br />
          {{ $img->product->product_name }}
        </td>
        <td>
          <img src="/storage/uploads/{{ $img->image }}" class="img-fluid hinh-anh-dai-dien"
            alt="{{ $img->product_name }}" />
        </td>
        <td>
          <a href="{{ route('backend.shop_product_images.edit', ['id' => $img->id]) }}" class="btn btn-warning">Sửa</a>

          <button type="button" class="btn btn-danger btn-delete" data-id="{{ $img->id }}"
            data-delete-url="{{ route('backend.shop_product_images.destroy', ['id' => $img->id]) }}">Xóa</button>
        </td>
      </tr>
    @endforeach
  </table>

  {!! $dsProductImages->links() !!}
@endsection

@section('custom-js')
  <script>
    $(function() {
      // Nhờ JQUERY tìm phần từ (element) đang có id #checkAll
      // -> yêu cầu đăng ký sự kiện change
      $('#checkAll').on('change', function() {
        var isCheckedAll = $(this).is(':checked');

        var listSelectElements = $("input[type='checkbox'][name='listSelectedIds[]']");
        $.each(listSelectElements, function(index, ele) {
          $(ele).attr('checked', isCheckedAll)
        });
      });


      // Nhờ JQUERY tìm phần tử (element) đang có id #btnBatchDelete
      // -> yêu cầu đăng ký sự kiện click
      $('#btnBatchDelete').on('click', function() {
        var batchDeleteUrl = $(this).attr("data-batch-delete-url");
        var btnBatchDelete = $(this);
        var listSelectedIds = [];

        var listSelectedElements = $("input[type='checkbox'][name='listSelectedIds[]']:checked");
        $.each(listSelectedElements, function(index, ele) {
          var id = $(ele).val();
          listSelectedIds.push(id);
        });

        Swal.fire({
          title: "Bạn có chắc chắn muốn xóa các dòng đã chọn hay không?",
          text: "Một khi xóa là không thể phục hồi!",
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          confirmButtonText: "Đồng ý!",
          cancelButtonColor: "#c3c3c3",
          cancelButtonText: "Hủy bỏ",
        }).then((result) => {
          if (result.isConfirmed) { // Người dùng xác nhận đồng ý
            // Nhờ JS gởi request đến server
            var postData = {
              '_token': '{{ csrf_token() }}',
              'listSelectedIds': listSelectedIds
            };
            $.post(batchDeleteUrl, postData)
              .done(function(response) {
                // debugger;
                Swal.fire({
                  title: "Xóa hàng loạt",
                  text: response.message,
                  icon: "info"
                });

                var list_deleted_ids = response.list_deleted_ids;
                $.each(list_deleted_ids, function(index, id) {
                  var selector = "input[type='checkbox'][name='listSelectedIds[]'][value=" + id + "]";
                  $(selector).parent().parent().parent().remove();
                });
              })
              .fail(function(e) {
                alert('error');
              });
          }
        });
      });

      // Nhờ JQUERY tìm phần tử (element) đang áp dụng class btn-delete
      // -> yêu cầu những phần tìm được làm cái gì đó? (action)
      // $(selector).action();
      $('.btn-delete').on('click', function() {
        var id = $(this).attr("data-id");
        var deleteUrl = $(this).attr("data-delete-url");
        var btnDelete = $(this);
        Swal.fire({
          title: "Bạn có chắc chắn muốn xóa không?",
          text: "Một khi xóa là không thể phục hồi!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          confirmButtonText: "Đồng ý!",
          cancelButtonColor: "#c3c3c3",
          cancelButtonText: "Hủy bỏ",
        }).then((result) => {
          if (result.isConfirmed) {
            // Nhờ JS gởi request đến server
            var postData = {
              '_token': '{{ csrf_token() }}',
              '_method': 'DELETE',
              'id': id
            };
            $.post(deleteUrl, postData)
              .done(function() {
                //alert('đã xóa thành công');
                btnDelete.parent().parent().remove();
              })
              .fail(function(e) {
                alert('error');
              });
          }
        });
      });
    });
  </script>
@endsection
