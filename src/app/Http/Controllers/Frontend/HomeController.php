<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopProduct;

class HomeController extends Controller
{
    // action index
    public function index() {
        // Tìm top 5 sản phẩm nổi bật
        $featured_products = ShopProduct::where('is_featured', '=', true)
            ->take(5)
            ->get(); // execute
        // dd($featured_products);

        // Tìm top 3 sản phẩm mới nhất
        $latest_products = ShopProduct::orderByDesc('updated_at')
            ->take(3)
            ->get();

        // Danh sách sản phẩm (phân trang)
        $products = ShopProduct::paginate(6);

        return view('frontend.index')
            ->with('featured_products', $featured_products)
            ->with('latest_products', $latest_products)
            ->with('products', $products);
    }
}
