<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AclRole;
use App\Models\AclPermission;
use App\Models\AclRoleHasPermission;
use App\Models\AclUserHasPermission;

class AclRoleHasPermissionController extends Controller
{
    public function index()
    {
        // $aclRoleHasPermissions = AclRoleHasPermission::all();
        // Eager loading
        $aclRoleHasPermissions =
            AclRoleHasPermission::with('role')
            ->with('permission')
            ->get();

        $groupedAclRoleHasPermissions = $aclRoleHasPermissions->groupBy('role.display_name');
        // dd($aclRoleHasPermissions, $groupedAclRoleHasPermissions->all());

        return view('backend.acl_role_has_permissions.index')
            ->with('groupedAclRoleHasPermissions', $groupedAclRoleHasPermissions);
    }

    public function create()
    {
        $aclRoles = AclRole::all();
        $aclPermissions = AclPermission::all();

        return view('backend.acl_role_has_permissions.create')
            ->with('aclRoles', $aclRoles)
            ->with('aclPermissions', $aclPermissions);
    }

    public function store(Request $request)
    {
        // dd($request);
        // 1. Xóa sạch hết các quyền đã cấp cho vai trò đó trong db
        if (!isset($request->permission_id) || empty($request->permission_id)) {
            $lstAclRoleHasPermissions = AclRoleHasPermission::where('role_id', $request->role_id)->get();
            foreach ($lstAclRoleHasPermissions as $auhr) {
                $auhr->delete();
            }
        } else {
            // Lấy dữ liệu các quyền đã được cấp
            $lstAclRoleHasPermissions = AclRoleHasPermission::where('role_id', $request->role_id)->get();
            foreach ($lstAclRoleHasPermissions as $auhr) {
                if (!in_array($auhr->permission_id, $request->permission_id)) {
                    $auhr->delete();
                }
            }
            // Data Valid: Xử lý lưu (INSERT LẠI)
            $arrPermissionIdInDb = $lstAclRoleHasPermissions->pluck('permission_id')->toArray();
            foreach ($request->permission_id as $permission_id) {
                if (!in_array($permission_id, $arrPermissionIdInDb)) {
                    $newModel = new AclRoleHasPermission();
                    $newModel->role_id = $request->role_id;
                    $newModel->permission_id = $permission_id;
                    $newModel->save();
                }
            }
        }
        return redirect(route('backend.acl_role_has_permissions.index'));
    }
}
