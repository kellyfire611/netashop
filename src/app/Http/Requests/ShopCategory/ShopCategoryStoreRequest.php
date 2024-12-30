<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShopCategoryStoreRequest extends FormRequest
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
        if (!Gate::allows('shop_categories::create')) {
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
            'category_code' => 'required|min:3|max:100',
            'category_name' => 'required',
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
            'category_code.required' => 'Mã chuyên mục bắt buộc nhập',
            'category_code.min' => 'Mã chuyên mục phải từ 3 ký tự trở lên',
            'category_code.max' => 'Mã chuyên mục phải chỉ tối đã 100 ký tự',
            'category_name.required' => 'Tên chuyên mục bắt buộc nhập',
        ];
    }
}
