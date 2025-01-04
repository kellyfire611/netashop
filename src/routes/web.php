<?php

use Illuminate\Support\Facades\Route;
use App\Models\AclUser;
use App\Models\AclRole;
use App\Models\AclPermission;
use App\Models\AclUserHasRole;
use App\Models\AclRoleHasPermission;
use App\Http\Controllers\Backend\ShopSettingController;
use App\Http\Controllers\Backend\ShopCategoryController;
use App\Http\Controllers\Backend\ShopSupplierController;
use App\Http\Controllers\Backend\ShopProductController;
use App\Http\Controllers\Backend\ShopProductImageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backend\ShopPostController;
use App\Http\Controllers\Backend\AclUserHasRoleController;
use App\Http\Controllers\Backend\AclRoleHasPermissionController;
use App\Http\Controllers\Api\AclRoleHasPermissionController as ApiAclRoleHasPermissionController;

// AUTH
Route::get('/active-user',
    [RegisterController::class, 'activeUser'])
    ->name('auth.register.active-user');

Route::get('/register-success',
    [RegisterController::class, 'registerSuccess'])
    ->name('auth.register.register-success');
Route::post('/register',
    [RegisterController::class, 'register'])
    ->name('auth.register.register');

Route::get('/register', 
    [RegisterController::class, 'index'])
    ->name('auth.register.index');

Route::get('/login',
    [LoginController::class, 'index'])
    ->name('auth.login.index');
Route::post('/login',
    [LoginController::class, 'login'])
    ->name('auth.login.login');
Route::post('/logout',
    [LoginController::class, 'logout'])
    ->name('auth.login.logout');

Route::get('generate-password', function() {
    return bcrypt('123456');
});

// BACKEND
// ------ Route liên quan về Chuyên mục sản phẩm
Route::get('/backend/chuyen-muc-san-pham', 
    [ShopCategoryController::class, 'index'])
    ->name('backend.shop_categories.index');
Route::get('/backend/chuyen-muc-san-pham/them',
    [ShopCategoryController::class, 'create'])
    ->name('backend.shop_categories.create');
Route::post('/backend/chuyen-muc-san-pham/store',
    [ShopCategoryController::class, 'store'])
    ->name('backend.shop_categories.store');
Route::get('/backend/chuyen-muc-san-pham/{id}',
    [ShopCategoryController::class, 'edit'])
    ->name('backend.shop_categories.edit');
Route::put('/backend/chuyen-muc-san-pham/{id}',
    [ShopCategoryController::class, 'update'])
    ->name('backend.shop_categories.update');
Route::delete('/backend/chuyen-muc-san-pham/{id}',
    [ShopCategoryController::class, 'destroy'])
    ->name('backend.shop_categories.destroy');

// ------ Route liên quan về Nhà cung cấp
Route::get('/backend/nha-cung-cap', 
    [ShopSupplierController::class, 'index'])
    ->name('backend.shop_suppliers.index');
Route::get('/backend/nha-cung-cap/them',
    [ShopSupplierController::class, 'create'])
    ->name('backend.shop_suppliers.create');
Route::post('/backend/nha-cung-cap/store',
    [ShopSupplierController::class, 'store'])
    ->name('backend.shop_suppliers.store');
Route::get('/backend/nha-cung-cap/{id}',
    [ShopSupplierController::class, 'edit'])
    ->name('backend.shop_suppliers.edit');
Route::put('/backend/nha-cung-cap/{id}',
    [ShopSupplierController::class, 'update'])
    ->name('backend.shop_suppliers.update');
Route::delete('/backend/nha-cung-cap/{id}',
    [ShopSupplierController::class, 'destroy'])
    ->name('backend.shop_suppliers.destroy');

// ------ Route liên quan về Sản phẩm
Route::get('/backend/san-pham', 
    [ShopProductController::class, 'index'])
    ->name('backend.shop_products.index');
Route::get('/backend/san-pham/them',
    [ShopProductController::class, 'create'])
    ->name('backend.shop_products.create');
Route::post('/backend/san-pham/store',
    [ShopProductController::class, 'store'])
    ->name('backend.shop_products.store');
Route::get('/backend/san-pham/{id}',
    [ShopProductController::class, 'edit'])
    ->name('backend.shop_products.edit');
Route::put('/backend/san-pham/{id}',
    [ShopProductController::class, 'update'])
    ->name('backend.shop_products.update');
Route::delete('/backend/san-pham/{id}',
    [ShopProductController::class, 'destroy'])
    ->name('backend.shop_products.destroy');

// ------ Route liên quan về Hình ảnh Sản phẩm 
Route::get('/backend/hinh-anh-san-pham', 
    [ShopProductImageController::class, 'index'])
    ->name('backend.shop_product_images.index');
Route::get('/backend/hinh-anh-san-pham/them',
    [ShopProductImageController::class, 'create'])
    ->name('backend.shop_product_images.create');
Route::post('/backend/hinh-anh-san-pham/store',
    [ShopProductImageController::class, 'store'])
    ->name('backend.shop_product_images.store');
Route::get('/backend/hinh-anh-san-pham/{id}',
    [ShopProductImageController::class, 'edit'])
    ->name('backend.shop_product_images.edit');
Route::put('/backend/hinh-anh-san-pham/{id}',
    [ShopProductImageController::class, 'update'])
    ->name('backend.shop_product_images.update');
Route::delete('/backend/hinh-anh-san-pham/{id}',
    [ShopProductImageController::class, 'destroy'])
    ->name('backend.shop_product_images.destroy');    


// --- Route chức năng Role_has_permissions
Route::get('/api/v1/acl_role_has_permissions/getByRoleId/{role_id?}',
    [ApiAclRoleHasPermissionController::class, 'getByRoleId'])
    ->name('api.acl_role_has_permissions.getByRoleId');

Route::get('/backend/cap-quyen-cho-vai-tro',
    [AclRoleHasPermissionController::class, 'index'])
    ->name('backend.acl_role_has_permissions.index');

Route::get('/backend/cap-quyen-cho-vai-tro/create',
    [AclRoleHasPermissionController::class, 'create'])
    ->name('backend.acl_role_has_permissions.create');

Route::post('/backend/cap-quyen-cho-vai-tro/create',
    [AclRoleHasPermissionController::class, 'store'])
    ->name('backend.acl_role_has_permissions.store');

// --- Route chức năng User_has_roles
Route::post('/backend/gan-vai-tro-cho-nguoi-dung/create',
    [AclUserHasRoleController::class, 'store'])
    ->name('backend.acl_user_has_roles.store');

Route::get('/backend/gan-vai-tro-cho-nguoi-dung/{username}/create',
    [AclUserHasRoleController::class, 'create_with_username'])
    ->name('backend.acl_user_has_roles.create_with_username');

Route::get('/backend/gan-vai-tro-cho-nguoi-dung/create',
    [AclUserHasRoleController::class, 'create'])
    ->name('backend.acl_user_has_roles.create');

Route::get('/backend/gan-vai-tro-cho-nguoi-dung',
    [AclUserHasRoleController::class, 'index'])
    ->name('backend.acl_user_has_roles.index');

// --- 

Route::get('/backend/bai-viet/create',
    [ShopPostController::class, 'create'])
    ->name('backend.shop_posts.create');

Route::post('/backend/bai-viet/store',
    [ShopPostController::class, 'store'])
    ->name('backend.shop_posts.store');

Route::delete('/backend/bai-viet/{id}',
    [ShopPostController::class, 'destroy'])
    ->name('backend.shop_posts.destroy');

Route::get('/backend/bai-viet/{id}',
    [ShopPostController::class, 'edit'])
    ->name('backend.shop_posts.edit');

Route::put('/backend/bai-viet/{id}',
    [ShopPostController::class, 'update'])
    ->name('backend.shop_posts.update');

Route::get('/backend/bai-viet',
    [ShopPostController::class, 'index'])
    ->name('backend.shop_posts.index');

Route::get('/backend/cau-hinh', 
    [ShopSettingController::class, 'index'])
    ->name('backend.shop_settings.index');

Route::get('/backend/cau-hinh/them',
    [ShopSettingController::class, 'create'])
    ->name('backend.shop_settings.create');

Route::post('/backend/cau-hinh/store',
    [ShopSettingController::class, 'store'])
    ->name('backend.shop_settings.store');

Route::get('/backend/cau-hinh/{id}',
    [ShopSettingController::class, 'edit'])
    ->name('backend.shop_settings.edit');

Route::put('/backend/cau-hinh/{id}',
    [ShopSettingController::class, 'update'])
    ->name('backend.shop_settings.update');


Route::delete('/backend/cau-hinh/{id}',
    [ShopSettingController::class, 'destroy'])
    ->name('backend.shop_settings.destroy');


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/test-model-acl-user', function() {
    $lstUsers = AclUser::all();
    $soLuongVaiTro = count($lstUsers[0]->roles);

    dd($lstUsers, $soLuongVaiTro);
});
Route::get('/test-model-acl-role', function() {
    $lstRoles = AclRole::all();
    $soLuongNguoiDung = count($lstRoles[0]->users);
    
    dd($lstRoles, $soLuongNguoiDung);
});
Route::get('/test-model-acl-permission', function() {
    $lstPermissions = AclPermission::all();
    dd($lstPermissions);
});
Route::get('/test-model-acl-user-has-roles', function() {
    $lstUserHasRoles = AclUserHasRole::all();

    dd(
        $lstUserHasRoles[0]->user->last_name,
        $lstUserHasRoles[0]->role->display_name
    );

    dd($lstUserHasRoles);
});
Route::get('/test-model-acl-role-has-permissions', function() {
    $lstRoleHasPermissions = AclRoleHasPermission::all();
    dd(
        $lstRoleHasPermissions[0]->role->display_name,
        $lstRoleHasPermissions[0]->permission->display_name
    );
    dd($lstRoleHasPermissions);
});
