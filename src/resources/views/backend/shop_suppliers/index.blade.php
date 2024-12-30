@extends('backend/layouts/master')

@section('title')
Danh sách Nhà cung cấp
@endsection

@section('main-content')
<h1>Danh sách Nhà cung cấp</h1>
Số lượng dữ liệu: {{ count($dsShopSuppliers) }}
<br />
<a class="btn btn-primary" href="{{ route('backend.shop_suppliers.create') }}">Thêm</a>
<table class="table table-bordered">
  <tr>
    <th>Id</th>
    <th>Ảnh</th>
    <th>Mã nhà cung cấp</th>
    <th>Tên nhà cung cấp</th>
    <th>Mô tả</th>
    <th>Ngày tạo</th>
    <th>Ngày cập nhật</th>
    <th>Hành động</th>
  </tr>
  @foreach($dsShopSuppliers as $sup)
  <tr>
    <td>{{ $sup->id }}</td>
    <td>
      <img src="/storage/uploads/{{ $sup->image }}" class="img-fluid hinh-anh-dai-dien" alt="{{ $sup->supplier_name }}" />
    </td>
    <td>{{ $sup->supplier_code }}</td>
    <td>{{ $sup->supplier_name }}</td>
    <td>{!! $sup->description !!}</td>
    <td>{{ $sup->created_at->diffForHumans() }}</td>
    <td>{{ $sup->updated_at == null ? '' : $sup->updated_at->diffForHumans() }}</td>
    <td>
      <a href="{{ route('backend.shop_suppliers.edit', ['id' => $sup->id]) }}" class="btn btn-warning">Sửa</a>

      <button type="button" class="btn btn-danger btn-delete"
        data-id="{{ $sup->id }}" data-delete-url="{{ route('backend.shop_suppliers.destroy', ['id' => $sup->id]) }}">Xóa</button>
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