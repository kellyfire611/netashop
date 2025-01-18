<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('frontend.index') }}">
      <img src="{{ asset('assets_frontend/img/logo/logo.png') }}" class="img-logo" />
      <b>NT</b>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('frontend.index') }}">
            <i class="fa-solid fa-house" style="color: red;"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Giỏ hàng</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Về chúng tôi
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Giới thiệu</a></li>
            <li><a class="dropdown-item" href="#">Liên hệ</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex me-auto" role="search">
        <input class="form-control me-2" type="search" placeholder="nhập từ khóa tìm kiếm" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link border position-relative" href="#">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              99+
              <span class="visually-hidden">có 99 sản phẩm</span>
            </span>
          </a>
        </li>
        <li class="nav-item ms-2">
          <a href="" class="nav-link btn">
            Đăng nhập
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
