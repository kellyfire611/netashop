@extends('backend/layouts/master')

@section('title')
  Danh sách Sản phẩm
@endsection

@section('main-content')
  <h1>Danh sách Sản phẩm</h1>
  Số lượng dữ liệu: {{ count($dsShopProducts) }}
  <br />
  <a class="btn btn-primary" href="{{ route('backend.shop_products.create') }}">Thêm</a>
  <table class="table table-bordered">
    <tr>
      <th>Id</th>
      <th>Ảnh</th>
      <th>Mã sản phẩm</th>
      <th>Tên sản phẩm</th>
      <th>Mô tả</th>
      <th>Giá</th>
      <th>Số lượng</th>
      <th>Tình trạng</th>
      <th>Ngày tạo</th>
      <th>Ngày cập nhật</th>
      <th>Hành động</th>
    </tr>
    @foreach ($dsShopProducts as $p)
      <tr>
        <td>{{ $p->id }}</td>
        <td>
          <img src="/storage/uploads/{{ $p->image }}" class="img-fluid hinh-anh-dai-dien" alt="{{ $p->product_name }}" />
        </td>
        <td>{{ $p->product_code }}</td>
        <td>
          <b>CM: {{ $p->category->category_name }}</b><br />
          <b>NCC: {{ $p->supplier->supplier_name }}</b><br />
          {{ $p->product_name }}
        </td>
        <td>{!! $p->short_description !!}</td>
        <td class="text-end">
          Giá nhập: {{ number_format($p->standard_cost, 0, '.', ',') }}đ
          <br />
          @if ($p->list_price > $p->standard_cost)
            <span class="gia-ban-co-loi">Giá bán: {{ number_format($p->list_price, 0, '.', ',') }}đ</span>
          @elseif($p->list_price == $p->standard_cost)
            <span class="gia-ban-hue-von">Giá bán: {{ number_format($p->list_price, 0, '.', ',') }}đ</span>
          @else
            <span class="gia-ban-lo-von">Giá bán: {{ number_format($p->list_price, 0, '.', ',') }}đ</span>
          @endif
        </td>
        <td class="text-end">
          {{ number_format($p->quantity_per_unit, 0, '.', ',') }}
        </td>
        <td>
          @if ($p->discontinued >= 1)
            <span class="badge bg-black">Ngừng kinh doanh</span>
          @endif

          @if ($p->is_featured >= 1)
            <span class="badge bg-success">Nổi bật</span>
          @endif

          @if ($p->is_new >= 1)
            <span class="badge bg-warning">Mới</span>
          @endif
        </td>
        <td>{{ $p->created_at == null ? '' : $p->created_at->diffForHumans() }}</td>
        <td>{{ $p->updated_at == null ? '' : $p->updated_at->diffForHumans() }}</td>
        <td>
          <a href="{{ route('backend.shop_products.edit', ['id' => $p->id]) }}" class="btn btn-warning">Sửa</a>

          <button type="button" class="btn btn-danger btn-delete" data-id="{{ $p->id }}"
            data-delete-url="{{ route('backend.shop_products.destroy', ['id' => $p->id]) }}">Xóa</button>
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
              .fail(function(err) {
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Bạn không có quyền thao tác!",
                }).then((result) => {
                  // Điều hướng
                  location.href = "{{ route('errors.403') }}";
                });
              });
          }
        });
      });
    });
  </script>
@endsection
