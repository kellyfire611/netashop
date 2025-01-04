@extends('backend/layouts/master')

@section('title')
Danh sách Hình Sản phẩm
@endsection

@section('main-content')
<h1>Danh sách Hình Sản phẩm</h1>
Số lượng dữ liệu: {{ count($dsProductImages) }}
<br />
<a class="btn btn-primary" href="{{ route('backend.shop_product_images.create') }}">Thêm</a>
<table class="table table-bordered">
  <tr>
    <th>Id</th>
    <th>Sản phẩm</th>
    <th>Ảnh</th>
    <th>Hành động</th>
  </tr>
  @foreach($dsProductImages as $img)
  <tr>
    <td>{{ $img->id }}</td>
    <td>
      <b>CM: {{ $img->product->category->category_name }}</b><br />
      <b>NCC: {{ $img->product->supplier->supplier_name }}</b><br />
      {{ $img->product->product_name }}
    </td>
    <td>
      <img src="/storage/uploads/{{ $img->image }}" class="img-fluid hinh-anh-dai-dien" alt="{{ $img->product_name }}" />
    </td>
    <td>
      <a href="{{ route('backend.shop_product_images.edit', ['id' => $img->id]) }}" class="btn btn-warning">Sửa</a>

      <button type="button" class="btn btn-danger btn-delete"
        data-id="{{ $img->id }}" data-delete-url="{{ route('backend.shop_product_images.destroy', ['id' => $img->id]) }}">Xóa</button>
    </td>
  </tr>
  @endforeach
</table>

@endsection

@section('custom-js')
<script>
  $(function() {
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