@extends('backend/layouts/master')

@section('title')
Gán vai trò cho người dùng
@endsection

@section('main-content')
<h1>Gán vai trò cho người dùng</h1>

<form name="frmCreate" method="post" action="{{ route('backend.acl_user_has_roles.store') }}">
  @csrf
  <div>
    <h2>({{ $username }}) {{ $aclUser->last_name }} {{ $aclUser->first_name }}</h2>
    <input type="hidden" name="user_id" value="{{ $aclUser->id }}" />
  </div>
  <hr />
  <div>
    <h5>Danh sách vai trò</h5>
    @foreach($lstRoles as $i => $r)
      <div class="form-check mb-2">
        @if(in_array($r->id, $lstAclUserHasRoles))
          <input class="form-check-input" type="checkbox" name="role_id[]" id="role_id_{{ $i }}" value="{{ $r->id }}" checked>
        @else
          <input class="form-check-input" type="checkbox" name="role_id[]" id="role_id_{{ $i }}" value="{{ $r->id }}">
        @endif

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