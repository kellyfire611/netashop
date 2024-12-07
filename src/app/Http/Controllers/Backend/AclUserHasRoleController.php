<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AclUser;
use App\Models\AclRole;
use App\Models\AclUserHasRole;

class AclUserHasRoleController extends Controller
{
    public function index() {
        
    }

    public function create() {
        $lstAclUsers = AclUser::all();
        $lstRoles = AclRole::all();

        // Access Control List
        return view('backend.acl_user_has_roles.create')
            ->with('lstAclUsers', $lstAclUsers)
            ->with('lstRoles', $lstRoles);
    }

    public function create_with_username($username) {
        $aclUser = AclUser::where('username', $username)->first();
        $lstRoles = AclRole::all();
        
        // Lấy dữ liệu các vai trò đã được cấp
        $lstAclUserHasRoles = AclUserHasRole::where('user_id', $aclUser->id)->select('role_id')->get()->pluck('role_id')->toArray();
        // dd($lstAclUserHasRoles);

        // Access Control List
        return view('backend.acl_user_has_roles.create_with_username')
            ->with('aclUser', $aclUser)
            ->with('lstRoles', $lstRoles)
            ->with('username', $username)
            ->with('lstAclUserHasRoles', $lstAclUserHasRoles);
    }

    public function store(Request $request) {
        // dd($request);
        // Validation

        // 1. Xóa sạch hết các vai trò đã cấp cho người đó trong db
        // Lấy dữ liệu các vai trò đã được cấp
        $lstAclUserHasRoles = AclUserHasRole::where('user_id', $request->user_id)->get();
        foreach($lstAclUserHasRoles as $auhr) {
            // $auhr->delete();
            if(!in_array($auhr->role_id, $request->role_id)) {
                $auhr->delete();
            }
        }

        // Data Valid: Xử lý lưu (INSERT LẠI)
        $arrRoleIdInDb = $lstAclUserHasRoles->pluck('role_id')->toArray();
        foreach($request->role_id as $role_id) {
            if(!in_array($role_id, $arrRoleIdInDb)) {
                $newModel = new AclUserHasRole();
                $newModel->user_id = $request->user_id;
                $newModel->role_id = $role_id;
                $newModel->save();
            }
        }

        return redirect(route('backend.acl_user_has_roles.index'));
    }
}
