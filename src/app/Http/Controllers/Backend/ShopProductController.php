<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopProduct;
use App\Models\ShopCategory;
use App\Http\Requests\ShopProduct\ShopProductIndexRequest;
use App\Http\Requests\ShopProduct\ShopProductCreateRequest;
use App\Http\Requests\ShopProduct\ShopProductStoreRequest;
use App\Http\Requests\ShopProduct\ShopProductDestroyRequest;
use App\Http\Requests\ShopProduct\ShopProductUpdateRequest;
use App\Models\ShopSupplier;
use Illuminate\Support\Facades\Storage;

class ShopProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShopProductIndexRequest $request)
    {
        $dsShopProducts = ShopProduct::all();
        // dd($dsShopProducts);

        return view('backend.shop_products.index')
            ->with('dsShopProducts', $dsShopProducts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ShopProductCreateRequest $request)
    {
        $dsCategories = ShopCategory::all();
        $dsSuppliers = ShopSupplier::all();

        return view('backend.shop_products.create')
            ->with('dsCategories', $dsCategories)
            ->with('dsSuppliers', $dsSuppliers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopProductStoreRequest $request)
    {
        // dd($request);
        $newModel = new ShopProduct();
        $newModel->product_code = $request->product_code;
        $newModel->product_name = $request->product_name;
        $newModel->short_description = $request->short_description;
        $newModel->description = $request->description;
        $newModel->standard_cost = $request->standard_cost;
        $newModel->list_price = $request->list_price;
        $newModel->quantity_per_unit = $request->quantity_per_unit;

        $newModel->discontinued = empty($request->discontinued) ? 0 : intval($request->discontinued);
        $newModel->is_featured = intval($request->is_featured) ?? 0;
        $newModel->is_new = intval($request->is_new) ?? 0;

        $newModel->category_id = $request->category_id;
        $newModel->supplier_id = $request->supplier_id;
        // dd($request, $newModel);

        // Kiểm tra xem người dùng có upload file không?
        if ($request->hasFile('image')) {
            // Lấy file
            $file = $request->image;
            // Sinh chuỗi ngày tháng năm giờ phút giây
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            
            // 1. Lưu vào trong db
            $newModel->image = 'products/' . $newFileName;
            // 2. Di chuyển từ thư mục tmp -> thư mục mong đợi
            $file->storeAs('uploads/products', $newFileName, 'public');
        }
    
        $newModel->save();
    
        // Điều hướng về route index
        return redirect(route('backend.shop_products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tìm dữ liệu cũ (dòng record người dùng đang muốn update)
        $updatingModel = ShopProduct::find($id);
        $dsCategories = ShopCategory::all();
        $dsSuppliers = ShopSupplier::all();

        return view('backend.shop_products.edit')
            ->with('updatingModel', $updatingModel)
            ->with('dsCategories', $dsCategories)
            ->with('dsSuppliers', $dsSuppliers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShopProductUpdateRequest $request, string $id)
    {
        // dd($request);
        $updatingModel = ShopProduct::find($id);
        $updatingModel->product_code = $request->product_code;
        $updatingModel->product_name = $request->product_name;
        $updatingModel->short_description = $request->short_description;
        $updatingModel->description = $request->description;
        $updatingModel->standard_cost = $request->standard_cost;
        $updatingModel->list_price = $request->list_price;
        $updatingModel->quantity_per_unit = $request->quantity_per_unit;

        $updatingModel->discontinued = empty($request->discontinued) ? 0 : intval($request->discontinued);
        $updatingModel->is_featured = intval($request->is_featured) ?? 0;
        $updatingModel->is_new = intval($request->is_new) ?? 0;

        $updatingModel->category_id = $request->category_id;
        $updatingModel->supplier_id = $request->supplier_id;
        // dd($request, $updatingModel);

        // Kiểm tra xem người dùng có upload file không?
        if ($request->hasFile('image')) {
            // 1. Xóa file cũ trong storage để tránh rác
            $filePath = 'uploads/' . $updatingModel->image;
            Storage::disk('public')->delete($filePath);

            // 2. Tạo file mới
            // Lấy file
            $file = $request->image;
            // Sinh chuỗi ngày tháng năm giờ phút giây
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            
            // 1. Lưu vào trong db
            $updatingModel->image = 'products/' . $newFileName;
            // 2. Di chuyển từ thư mục tmp -> thư mục mong đợi
            $file->storeAs('uploads/products', $newFileName, 'public');
        }
    
        $updatingModel->save();
    
        // Điều hướng về route index
        return redirect(route('backend.shop_products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopProductDestroyRequest $request, $id)
    {
        $deletingModel = ShopProduct::find($id);
        // dd($deletingModel);

        // Xóa file không sử dụng nữa (file RÁC)
        if($deletingModel != null) {
            // Xóa file trong storage
            $filePath = 'uploads/' . $deletingModel->image;
            // dd($filePath);
            Storage::disk('public')->delete($filePath);

            $deletingModel->delete();
        }

         // Điều hướng về route index
         return redirect(route('backend.shop_products.index'));
    }
}
