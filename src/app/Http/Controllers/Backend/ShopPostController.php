<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopPost;
use App\Models\AclUser;
use App\Models\ShopPostCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShopPostController extends Controller
{
  // Hàm khởi tạo
  public function __construct()
  {
    // Policy kiểm tra quyền
  }

  // action index
  public function index()
  {
    // Authentication
    // Kiểm tra xem có đăng nhập chưa?
    if (!Auth::check()) {
      return redirect(route('auth.login.index'));
    }

    // Kiểm tra quyền (Authorization)
    // - Nếu có quyền thì thực thi action
    // - Nếu không có quyền thì hiển thị 403: bạn không có quyền truy cập chức năng.
    $hasPermission = false;
    $permission = 'shop_posts::view';
    $hasPermission = netaHasPermission(Auth::user(), $permission);

    if (!$hasPermission) {
      return abort(403);
    }

    $lstPosts = ShopPost::all();

    return view('backend.shop_posts.index')
      ->with('lstPosts', $lstPosts);
  }

  // action create
  public function create()
  {
    // Authentication
    // Kiểm tra xem có đăng nhập chưa?
    if (!Auth::check()) {
      return redirect(route('auth.login.index'));
    }

    // Kiểm tra quyền (Authorization)
    // - Nếu có quyền thì thực thi action
    // - Nếu không có quyền thì hiển thị 403: bạn không có quyền truy cập chức năng.
    if(!Gate::allows('shop_posts::create')) {
      abort(403);
    }

    $lstUsers = AclUser::all();
    $lstPostCaterories = ShopPostCategory::all();

    return view('backend.shop_posts.create')
      ->with('lstUsers', $lstUsers)
      ->with('lstPostCaterories', $lstPostCaterories);
  }

  // action store
  public function store(Request $request)
  {
    // Authentication
    // Kiểm tra xem có đăng nhập chưa?
    if (!Auth::check()) {
      return redirect(route('auth.login.index'));
    }

    // Kiểm tra quyền (Authorization)
    // - Nếu có quyền thì thực thi action
    // - Nếu không có quyền thì hiển thị 403: bạn không có quyền truy cập chức năng.
    if(!Gate::allows('shop_posts::create')) {
      abort(403);
    }

    //dd($request);
    // Tạo mới model ShopPost
    $newPost = new ShopPost();
    $newPost->post_slug = $request->post_slug;
    $newPost->post_title = $request->post_title;
    $newPost->post_content = $request->post_content;
    $newPost->post_excerpt = $request->post_excerpt;
    $newPost->post_type = $request->post_type;
    $newPost->post_status = $request->post_status;
    $newPost->user_id = $request->user_id;
    $newPost->post_category_id = $request->post_category_id;

    // Kiểm tra xem người dùng có upload file không?
    if ($request->hasFile('post_image')) {
      // Lấy file
      $file = $request->post_image;
      // Sinh chuỗi ngày tháng năm giờ phút giây
      $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
      // 1. Lưu vào trong db
      $newPost->post_image = $newFileName;
      // 2. Di chuyển từ thư mục tmp -> thư mục mong đợi
      // dd($file);
      $file->storeAs('uploads/posts', $newFileName, 'public');
    }

    $newPost->save();

    // Điều hướng về route index
    return redirect(route('backend.shop_posts.index'));
  }

  // action edit
  public function edit($id) {}

  // action update
  public function update($id, Request $request) {
    if(!Gate::allows('shop_posts::update')) {
      abort(403);
    }
  }

  // action destroy
  public function destroy($id) {}
}
