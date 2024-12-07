@extends('backend/layouts/master')

@section('title')
Danh sách cấu hình
@endsection

@section('main-content')
<h1>Danh sách Cấu hình</h1>
Số lượng dữ liệu: {{ count($dsShopSettings) }}
<br />
<a class="btn btn-primary" href="{{ route('backend.shop_settings.create') }}">Thêm</a>
<table class="table table-bordered">
  <tr>
    <th>Id</th>
    <th>Nhóm</th>
    <th>Mã</th>
    <th>Giá trị</th>
    <th>Mô tả</th>
    <th>Ngày tạo</th>
    <th>Ngày cập nhật</th>
    <th>Hành động</th>
  </tr>
  @foreach($dsShopSettings as $s)
  <tr>
    <td>{{ $s->id }}</td>
    <td>{{ $s->group }}</td>
    <td>{{ $s->key }}</td>
    <td>{{ $s->value }}</td>
    <td>{{ $s->description }}</td>
    <td>{{ $s->created_at->diffForHumans() }}</td>
    <td>{{ $s->updated_at }}</td>
    <td>
      <a href="{{ route('backend.shop_settings.edit', ['id' => $s->id]) }}" class="btn btn-warning">Sửa</a>
      <!-- <form method="post" 
        action="{{ route('backend.shop_settings.destroy', ['id' => $s->id]) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">Xóa</button>
        </form> -->

      <button type="button" class="btn btn-danger btn-delete"
        data-id="{{ $s->id }}" data-delete-url="{{ route('backend.shop_settings.destroy', ['id' => $s->id]) }}">Xóa</button>
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