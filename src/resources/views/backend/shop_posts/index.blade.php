@extends('backend/layouts/master')

@section('title')
Danh sách bài viết
@endsection

@section('main-content')
<h1>Danh sách bài viết</h1>

<a class="btn btn-primary" href="{{ route('backend.shop_posts.create') }}">Thêm mới</a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Hình</th>
      <th>Slug</th>
      <th>Tiêu đề</th>
      <th>Loại bài viết</th>
      <th>Trạng thái</th>
      <th>Tác giả</th>
      <th>Chuyên mục</th>
      <th>Ngày cập nhật</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach($lstPosts as $p)
      <tr>
        <td>
          <img src="/storage/uploads/posts/{{ $p->post_image }}" class="img-fluid" />
        </td>
        <td>{{ $p->post_slug }}</td>
        <td>{{ $p->post_title }}</td>
        <td>{{ $p->post_type }}</td>
        <td>
          @if($p->post_status == 'draft')
            <span class="badge bg-primary-subtle text-primary">
              {{ $p->post_status }}
            </span>
          @elseif($p->post_status == 'publish')
            <span class="badge text-bg-primary">
              {{ $p->post_status }}
            </span>
          @endif
        </td>
        <td>{{ $p->user->last_name }} {{ $p->user->first_name }}</td>
        <td>{{ $p->post_category->post_category_name }}</td>
        <td>{{ $p->updated_at->format('d/m/Y H:i:s') }}</td>
        <td>
          <a href="{{ route('backend.shop_posts.edit', ['id' => $p->id]) }}" class="btn btn-warning">Sửa</a>

          <button type="button" class="btn btn-danger btn-delete"
        data-id="{{ $p->id }}" data-delete-url="{{ route('backend.shop_posts.destroy', ['id' => $p->id]) }}">Xóa</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection