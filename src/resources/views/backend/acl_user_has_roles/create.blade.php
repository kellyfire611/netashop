@extends('backend/layouts/master')

@section('title')
Gán vai trò cho người dùng
@endsection

@section('main-content')
<h1>Gán vai trò cho người dùng</h1>

<form name="frmCreate" method="post" action="{{ route('backend.acl_user_has_roles.store') }}">
  @csrf
  <div>
    <label for="user_id" class="form-label">Người dùng</label>
    <select name="user_id" class="form-control">
      @foreach($lstAclUsers as $u)
        <option value="{{ $u->id }}">({{ $u->username }}) {{ $u->last_name }} {{ $u->first_name }}</option>
      @endforeach
    </select>
  </div>
  <hr />
  <div>
    <h5>Danh sách vai trò</h5>
    @foreach($lstRoles as $i => $r)
      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" name="role_id[]" id="role_id_{{ $i }}" value="{{ $r->id }}">
        <label class="form-check-label" for="role_id_{{ $i }}">
          {{ $r->display_name }}
        </label>
      </div>
    @endforeach
  </div>
  <div class="mt-2">
    <a href="{{ route('backend.acl_user_has_roles.index') }}" class="btn btn-outline-secondary waves-effect waves-light material-shadow-none">Quay về Danh sách</a>

    <button type="submit" class="btn btn-primary waves-effect waves-light">Lưu</button>
  </div>
</form>
@endsection