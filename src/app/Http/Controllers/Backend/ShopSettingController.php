<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopSetting;
use Validator;

class ShopSettingController extends Controller
{
    // action index
    public function index() {
        $dsShopSettings = ShopSetting::all();

        return view('backend/shop_settings/index')
            ->with('dsShopSettings', $dsShopSettings);
    }

    // action Create: hiển thị ra FORM giao diện cho người dùng nhập liệu
    public function create() {
        return view('backend/shop_settings/create');
    }

    // action Store: lưu dữ liệu vào database
    public function store(Request $request) {
        // Kiểm tra tính hợp lệ của dữ liệu gởi đến
        $validator = Validator::make($request->all(), [
            'group' => 'required|min:3|max:50',
            'key' => 'required',
            'value' => 'required',
        ], 
        // messages
        [
            'group.required' => 'Tên nhóm bắt buộc nhập.',
            'group.min' => 'Tên nhóm phải từ 3 ký tự trở lên.',
            'group.max' => 'Tên nhóm phải ít hơn 50 ký tự.',
            'key.required' => 'Từ khóa bắt buộc nhập',
            'value.required' => 'Giá trị bắt buộc nhập',
        ]);

        // Xử lý logic chuyển hướng hay là tiến hành lưu
        if($validator->fails()) {
            return redirect(route('backend.shop_settings.create'))
                ->withErrors($validator)
                ->withInput();
        }

        //
        $newModel = new ShopSetting();
        $newModel->group = $request->group;
        $newModel->key = $request->key;
        $newModel->value = $request->value;
        $newModel->description = $request->description;
        $newModel->created_at = date('Y-m-d H:i:s');
        $newModel->save();

        toastify()->success('Thêm mới thành công');
        return redirect(route('backend.shop_settings.index'));
    }

    // Action edit: hiển thị FORM để người dùng chỉnh sửa với dữ liệu cũ.
    public function edit($id) {
        // Tìm dữ liệu
        $editModel = ShopSetting::find($id);

        return view('backend/shop_settings/edit')
            ->with('editModel', $editModel);
    }

    // action Update: cập nhật dữ liệu trong database
    public function update($id, Request $request) {
        // Tìm dữ liệu
        $editModel = ShopSetting::find($id);
        $editModel->group = $request->group;
        $editModel->key = $request->key;
        $editModel->value = $request->value;
        $editModel->description = $request->description;
        $editModel->updated_at = date('Y-m-d H:i:s');
        $editModel->save();
        toastify()->success('Cập nhật thành công');
        return redirect(route('backend.shop_settings.index'));
    }

    public function destroy($id) {
        ShopSetting::destroy($id);

        toastify()->success('Đã xóa thành công');
        return redirect(route('backend.shop_settings.index'));
    }
}
