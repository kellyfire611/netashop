<?php

use Illuminate\Support\Facades\Route;
use App\Models\AclUser;
use App\Models\AclRole;
use App\Models\AclPermission;
use App\Models\AclUserHasRole;
use App\Models\AclRoleHasPermission;
use App\Http\Controllers\Backend\ShopSettingController;

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
});

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
