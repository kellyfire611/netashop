@extends('backend/layouts/master')

@section('title')
Cấp quyền cho vai trò
@endsection

@section('main-content')
@php
// 1. Kiểm tra xem request có query parameter (parameter URL) "role_id" hay không?
// - Nếu có thì gán giá trị đó cho SELECT chọn VAI TRÒ
$role_id = request()->query('role_id');
@endphp

<h1>Cấp quyền cho vai trò</h1>

<form name="frmCreate" method="post" action="{{ route('backend.acl_role_has_permissions.store') }}">
  @csrf
  <div>
    <label for="role_id" class="form-label">Vai trò</label>
    @if(!empty($role_id))
      <select name="role_id" id="role_id" class="form-control" disabled>
        @foreach($aclRoles as $r)
          <option value="{{ $r->id }}">{{ $r->display_name }}</option>
        @endforeach
      </select>
      <input type="hidden" name="role_id" value="{{ $role_id }}" />
    @else
      <select name="role_id" id="role_id" class="form-control">
        {{-- <option value="">Mời bạn chọn Vai trò</option> --}}
        @foreach($aclRoles as $r)
          <option value="{{ $r->id }}">{{ $r->display_name }}</option>
        @endforeach
      </select>
    @endif
  </div>
  <hr />
  <div id="permission_id">
    <h5>Danh sách các quyền</h5>
    @foreach($aclPermissions as $i => $p)
      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" name="permission_id[]" id="permission_id_{{ $i }}" value="{{ $p->id }}">
        <label class="form-check-label" for="permission_id_{{ $i }}">
          {{ $p->display_name }}
        </label>
      </div>
    @endforeach
  </div>
  <div class="mt-2">
    <a href="{{ route('backend.acl_role_has_permissions.index') }}" class="btn btn-outline-secondary waves-effect waves-light material-shadow-none">Quay về Danh sách</a>

    <button type="submit" class="btn btn-primary waves-effect waves-light">Lưu</button>
  </div>
</form>
@endsection

@section('custom-js')
<script>
  // AJAX: kỹ thuật nhờ Javascript gởi request đến API nào đó
  // Tùy theo phản hồi (response) trả về, bạn xử lý trên giao diện
  // - Thành công: thay đổi 1 phần giao diện.
  // - Thất bại: thay đổi 1 phần giao diện, hiển thị thông báo lỗi.
  $(function() {
    // Tìm element đó -> yêu cầu nó làm cái gì đó
    $('#role_id').on('change', function() {
      // Lấy giá trị của select
      var role_id = $(this).val();
      var apiUrl = "{{ route('api.acl_role_has_permissions.getByRoleId') }}";
      apiUrl += '/' + role_id;

      // Gọi API
      $.ajax({
        method: 'GET',
        url: apiUrl,
      })
      .done(function(response) {
        // debugger;
        var arrPermission = response.data;

        // 1. Tìm danh sách các checkbox quyền
        $("#permission_id input[type='checkbox']").each(function() {
          var value = Number($(this).val());
          if(arrPermission.includes(value)) {
            $(this).prop('checked', true);
          } else {
            $(this).prop('checked', false);
          }
        });
      });
    });

    @if(!empty($role_id))
      $('#role_id').val({{ $role_id }});
      $('#role_id').trigger('change');
    @endif

    $('#role_id').trigger('change');
  });
</script>
@endsection