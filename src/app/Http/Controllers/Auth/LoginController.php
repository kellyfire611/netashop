<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/'; //Sau khi đăng nhập thành công, sẽ tự động trỏ về trang /admin/

    public function index()
    {
        return view('auth/login/index');
    }

    /**
     * Hàm trả về tên cột dùng để tìm `Tên đăng nhập`.
     * Thông thường là cột `username` hoặc cột `email`
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $cred = $request->only($this->username(), 'password');
        return $cred;
    }

    /**
     * Hàm dùng để Kiểm tra tính hợp lệ của dữ liệu (VALIDATE) khi Xác thực tài khoản
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string', // tên tài khoản bắt buộc nhập
            'password' => 'required|string',      // mật khẩu bắt buộc nhập
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
}
