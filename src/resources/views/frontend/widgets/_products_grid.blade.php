<?php
use Illuminate\Support\Str;
?>
@if (!isset($products) || $products == null || count($products) == 0)
  <div class="products-grid">
    <span>Không có sản phẩm</span>
  </div>
@else
  <div class="products-grid">
    <div class="row row-cols-3">
      @foreach ($products as $product)
        <div class="col">
          <div class="card h-100">
            <img src="/storage/uploads/{{ $product->image }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $product->product_name }}</h5>
              <p class="card-text">{{ Str::substr($product->short_description, 0, 20) }}</p>
              <a href="#" class="btn btn-primary">Chi tiết</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif
