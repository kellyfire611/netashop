@extends('frontend.layouts.master')

@section('title')
  Trang chủ Bán hàng
@endsection

@section('page-styles')
  <link href="{{ asset('assets_frontend/css/index.css') }}" type="text/css" rel="stylesheet" />
@endsection

@section('content')
  {{-- Section hot products START --}}
  <section id="hot-products-section">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h3 class="text-center display-5">Top 5 sản phẩm nổi bật</h3>
          @include('frontend.widgets._products_grid', ['products' => $featured_products])
        </div>
        <div class="col-6">
          <h3 class="text-center display-5">Top 3 sản phẩm mới nhất</h3>
          @include('frontend.widgets._products_grid', ['products' => $latest_products])
        </div>
      </div>
    </div>
  </section>
  {{-- Section hot products END --}}

  {{-- Section Danh sách sản phẩm START --}}
  <section id="products-section">
    <div class="container">
      <div class="row">
        <div class="col">
          <h2 class="text-center display-2">Danh sách sản phẩm</h2>
          @include('frontend.widgets._products_grid', ['products' => $products])

          {{ $products->links() }}
        </div>
      </div>
    </div>
  </section>
  {{-- Section Danh sách sản phẩm END --}}
@endsection

@section('page-scripts')
<script src="{{ asset('assets_frontend/js/index.js') }}"></script>
@endsection
