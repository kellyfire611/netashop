@extends('backend/layouts/master')

@section('title')
Danh sách Chuyên mục sản phẩm
@endsection

@section('main-content')
<h1>Danh sách Chuyên mục sản phẩm</h1>
Số lượng dữ liệu: {{ count($dsShopCategories) }}
<br />
<a class="btn btn-primary" href="{{ route('backend.shop_categories.create') }}">Thêm</a>
<table class="table table-bordered">
  <tr>
    <th>Id</th>
    <th>Ảnh</th>
    <th>Mã chuyên mục</th>
    <th>Tên chuyên mục</th>
    <th>Mô tả</th>
    <th>Ngày tạo</th>
    <th>Ngày cập nhật</th>
    <th>Hành động</th>
  </tr>
  @foreach($dsShopCategories as $cat)
  <tr>
    <td>{{ $cat->id }}</td>
    <td>
      <img src="/storage/uploads/{{ $cat->image }}" class="img-fluid hinh-anh-dai-dien" alt="{{ $cat->category_name }}" />
    </td>
    <td>{{ $cat->category_code }}</td>
    <td>{{ $cat->category_name }}</td>
    <td>{!! $cat->description !!}</td>
    <td>{{ $cat->created_at->diffForHumans() }}</td>
    <td>{{ $cat->updated_at }}</td>
    <td>
      <a href="{{ route('backend.shop_categories.edit', ['id' => $cat->id]) }}" class="btn btn-warning">Sửa</a>

      <button type="button" class="btn btn-danger btn-delete"
        data-id="{{ $cat->id }}" data-delete-url="{{ route('backend.shop_categories.destroy', ['id' => $cat->id]) }}">Xóa</button>
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