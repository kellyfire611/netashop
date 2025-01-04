<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopProductImage\ShopProductImageStoreRequest;
use App\Http\Requests\ShopProductImage\ShopProductImageDestroyRequest;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use App\Models\ShopProductImage;
use Illuminate\Support\Facades\Storage;

class ShopProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dsProductImages = ShopProductImage::all();

        return view('backend.shop_product_images.index')
            ->with('dsProductImages', $dsProductImages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dsProducts = ShopProduct::all();
        return view('backend.shop_product_images.create')
            ->with('dsProducts', $dsProducts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopProductImageStoreRequest $request)
    {
        $newModel = new ShopProductImage();
        $newModel->product_id = $request->product_id;
        // dd($request, $newModel, $request->hasFile('file'));

        // Kiểm tra xem người dùng có upload file không?
        if ($request->hasFile('file')) {
            // Lấy file
            $file = $request->file;
            // Sinh chuỗi ngày tháng năm giờ phút giây
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();

            // 1. Lưu vào trong db
            $newModel->image = 'product-images/' . $newFileName;
            // 2. Di chuyển từ thư mục tmp -> thư mục mong đợi
            $file->storeAs('uploads/product-images', $newFileName, 'public');
        }

        $newModel->save();

        // Điều hướng về route index
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Thêm mới hình thành công',
            ]
        );
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
    public function destroy(ShopProductImageDestroyRequest $request, $id)
    {
        $deletingModel = ShopProductImage::find($id);
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
         return redirect(route('backend.shop_product_images.index'));
    }
}
