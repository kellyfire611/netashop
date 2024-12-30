<?php

namespace App\Http\Requests\ShopProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShopProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Nếu chưa đăng nhập -> tức là k có quyền truy cập
        if(!Auth::check()) {
            return false;
        }
        // Nếu đã đăng nhập -> mà không vượt qua cửa an ninh (Gate) -> tức là k có quyền truy cập
        if(!Gate::allows('shop_products::update')) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_code' => 'required|min:3|max:100',
            'product_name' => 'required',
            'standard_cost' => 'required',
            'list_price' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'product_code.required' => 'Mã sản phẩm bắt buộc nhập',
            'product_code.min' => 'Mã sản phẩm phải từ 3 ký tự trở lên',
            'product_code.max' => 'Mã sản phẩm phải chỉ tối đã 100 ký tự',
            'product_name.required' => 'Tên sản phẩm bắt buộc nhập',
            'standard_cost.required' => 'Giá nhập sản phẩm bắt buộc nhập',
            'list_price.required' => 'Giá niêm yết sản phẩm bắt buộc nhập',
            'category_id.required' => 'Chuyên mục sản phẩm bắt buộc chọn',
            'supplier_id.required' => 'Nhà cung cấp sản phẩm bắt buộc chọn',
        ];
    }
}
