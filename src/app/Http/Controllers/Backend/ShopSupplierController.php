<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopSupplier;
use App\Http\Requests\ShopSupplier\ShopSupplierIndexRequest;
use App\Http\Requests\ShopSupplier\ShopSupplierCreateRequest;
use App\Http\Requests\ShopSupplier\ShopSupplierStoreRequest;
use App\Http\Requests\ShopSupplier\ShopSupplierDestroyRequest;
use App\Http\Requests\ShopSupplier\ShopSupplierUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ShopSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShopSupplierIndexRequest $request)
    {
        $dsShopSuppliers = ShopSupplier::all();

        return view('backend.shop_suppliers.index')
            ->with('dsShopSuppliers', $dsShopSuppliers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ShopSupplierCreateRequest $request)
    {
        return view('backend.shop_suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopSupplierStoreRequest $request)
    {
        // $validated = $request->validated();
        // dd($validated);
        $newModel = new ShopSupplier();
        $newModel->supplier_code = $request->supplier_code;
        $newModel->supplier_name = $request->supplier_name;
        $newModel->description = $request->description;

        // Kiểm tra xem người dùng có upload file không?
        if ($request->hasFile('image')) {
            // Lấy file
            $file = $request->image;
            // Sinh chuỗi ngày tháng năm giờ phút giây
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            
            // 1. Lưu vào trong db
            $newModel->image = 'suppliers/' . $newFileName;
            // 2. Di chuyển từ thư mục tmp -> thư mục mong đợi
            $file->storeAs('uploads/suppliers', $newFileName, 'public');
        }
    
        $newModel->save();
    
        // Điều hướng về route index
        return redirect(route('backend.shop_suppliers.index'));
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
        $updatingModel = ShopSupplier::find($id);

        return view('backend.shop_suppliers.edit')
            ->with('updatingModel', $updatingModel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShopSupplierUpdateRequest $request, string $id)
    {
        $updatingModel = ShopSupplier::find($id);
        $updatingModel->supplier_code = $request->supplier_code;
        $updatingModel->supplier_name = $request->supplier_name;
        $updatingModel->description = $request->description;

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
            $updatingModel->image = 'suppliers/' . $newFileName;
            // 2. Di chuyển từ thư mục tmp -> thư mục mong đợi
            $file->storeAs('uploads/suppliers', $newFileName, 'public');
        }
    
        $updatingModel->save();
    
        // Điều hướng về route index
        return redirect(route('backend.shop_suppliers.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopSupplierDestroyRequest $request, $id)
    {
        $deletingModel = ShopSupplier::find($id);
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
         return redirect(route('backend.shop_suppliers.index'));
    }
}
