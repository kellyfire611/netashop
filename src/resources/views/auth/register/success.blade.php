@extends('auth.layouts.master')

@section('title')
Đăng ký tài khoản thành công
@endsection

@section('main-content')
  @if(session()->has('newUser'))
  <div style="position: relative; z-index: 99;">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4 card-bg-fill">
          <h1>Đăng ký tài khoản thành công</h1>
          <p>Chào mừng bạn {{ session('newUser')->last_name }} {{ session('newUser')->first_name }} đã đăng ký tài khoản thành công.</p>

          <p>Chúng tôi đã gởi mail kích hoạt đến email {{ session('newUser')->email }}. Vui lòng kiểm tra email để kích hoạt tài khoản.</p>

          <a href="{{ route('home') }}">Quay về trang chủ</a>
        </div>
      </div>
    </div>
  </div>
  @else
  <script>
  location.href = "{{ route('auth.register.index') }}";
  </script>
  @endif
@endsection