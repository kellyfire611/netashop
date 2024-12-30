<?php

namespace App\Http\Requests\ShopSupplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShopSupplierStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Nếu chưa đăng nhập -> tức là k có quyền truy cập
        if (!Auth::check()) {
            return false;
        }
        // Nếu đã đăng nhập -> mà không vượt qua cửa an ninh (Gate) -> tức là k có quyền truy cập
        if (!Gate::allows('shop_suppliers::create')) {
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
            'supplier_code' => 'required|min:3|max:100',
            'supplier_name' => 'required',
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
            'supplier_code.required' => 'Mã nhà cung cấp bắt buộc nhập',
            'supplier_code.min' => 'Mã nhà cung cấp phải từ 3 ký tự trở lên',
            'supplier_code.max' => 'Mã nhà cung cấp phải chỉ tối đã 100 ký tự',
            'supplier_name.required' => 'Tên nhà cung cấp bắt buộc nhập',
        ];
    }
}
