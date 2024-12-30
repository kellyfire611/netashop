@extends('backend/layouts/master')

@section('title')
  Danh sách các quyền theo vai trò
@endsection

@section('main-content')
  <h1>Danh sách các quyền theo vai trò</h1>

  <a class="btn btn-primary" href="{{ route('backend.acl_role_has_permissions.create') }}">Cấp quyền cho vai trò</a>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Vai trò</th>
        <th>Quyền đã cấp</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($groupedAclRoleHasPermissions as $key => $grhp)
        <?php
        $role_id = $grhp->first()->role_id;
        ?>
        <tr>
          <td>{{ $key }}</td>
          <td>
            <ul>
              @foreach ($grhp as $rhp)
                <li>{{ $rhp->permission->display_name }}</li>
              @endforeach
            </ul>
          </td>
          <td>
            <a href="{{ route('backend.acl_role_has_permissions.create', ['role_id' => $role_id]) }}" class="btn btn-warning">Hiệu chỉnh quyền cho vai trò</a>

            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $role_id }}"
            data-delete-url="{{ route('backend.acl_role_has_permissions.store') }}">Thu hồi tất cả các quyền đã cấp cho vai trò</button>
          </td>
        </tr>
      @endforeach
    </tbody>
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
        title: "Bạn có chắc chắn muốn thu hồi tất cả các quyền đã cấp cho vai trò không?",
        text: "Một khi thu hồi là không thể khôi phục!",
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
            '_method': 'POST',
            'role_id': id
          };
          $.post(deleteUrl, postData)
            .done(function() {
              // alert('đã thu hồi các quyền thành công');
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