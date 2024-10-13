<?php

use Illuminate\Support\Facades\Route;
use App\Models\AclUser;
use App\Models\AclRole;
use App\Models\AclPermission;
use App\Models\AclUserHasRole;
use App\Models\AclRoleHasPermission;

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