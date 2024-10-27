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
        <form method="post" 
        action="{{ route('backend.shop_settings.destroy', ['id' => $s->id]) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">Xóa</button>
        </form>
      </td>
    </tr>
  @endforeach
</table>

@endsection