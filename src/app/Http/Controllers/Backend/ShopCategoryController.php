<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopCategory;
use App\Http\Requests\ShopCategoryIndexRequest;
use App\Http\Requests\ShopCategoryCreateRequest;
use App\Http\Requests\ShopCategoryStoreRequest;
use App\Http\Requests\ShopCategoryDestroyRequest;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShopCategoryIndexRequest $request)
    {
        $dsShopCategories = ShopCategory::all();

        return view('backend.shop_categories.index')
            ->with('dsShopCategories', $dsShopCategories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ShopCategoryCreateRequest $request)
    {
        return view('backend.shop_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopCategoryStoreRequest $request)
    {
        // $validated = $request->validated();
        // dd($validated);
        $newModel = new ShopCategory();
        $newModel->category_code = $request->category_code;
        $newModel->category_name = $request->category_name;
        $newModel->description = $request->description;

        // Kiểm tra xem người dùng có upload file không?
        if ($request->hasFile('image')) {
            // Lấy file
            $file = $request->image;
            // Sinh chuỗi ngày tháng năm giờ phút giây
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            
            // 1. Lưu vào trong db
            $newModel->image = 'categories/' . $newFileName;
            // 2. Di chuyển từ thư mục tmp -> thư mục mong đợi
            $file->storeAs('uploads/categories', $newFileName, 'public');
        }
    
        $newModel->save();
    
        // Điều hướng về route index
        return redirect(route('backend.shop_categories.index'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopCategoryDestroyRequest $request, $id)
    {
        $deletingModel = ShopCategory::find($id);
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
         return redirect(route('backend.shop_categories.index'));
    }
}
