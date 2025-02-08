@extends('backend/layouts/master')

@section('title')
Không có quyền truy cập
@endsection

@section('main-content')
<h1>Xin lỗi, bạn không có quyền truy cập chức năng này.</h1>
<a href="{{ url()->previous() }}" class="btn btn-secondary">Quay về trang trước đó</a>
<a href="{{ route('frontend.index') }}" class="btn btn-primary">Quay về trang chủ</a>
@endsection