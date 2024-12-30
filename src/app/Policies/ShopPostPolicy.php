<?php

namespace App\Policies;

use App\Models\AclUser;
use App\Models\ShopPost;
use Illuminate\Auth\Access\Response;

class ShopPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(AclUser $aclUser): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(AclUser $aclUser, ShopPost $shopPost): bool
    {
        netaHasPermission($aclUser, 'shop_posts::view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(AclUser $aclUser): bool
    {
        if($aclUser->username == 'dnpcuong') {
            return false;
        }

        $hasPermissionChucNang = netaHasPermission($aclUser, 'shop_posts::create');

        return ($hasPermissionChucNang)
            ? Response::allow()
            : Response::deny('Bạn không được quyền thêm bài viết.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(AclUser $aclUser, ShopPost $shopPost): bool
    {
        $hasPermissionChucNang = netaHasPermission($aclUser, 'shop_posts::update');
        $hasPermissionDuLieu = $aclUser->id == $shopPost->user_id;

        return ($hasPermissionChucNang && $hasPermissionDuLieu)
            ? Response::allow()
            : Response::deny('Bạn không được quyền sửa những bài viết của người khác.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(AclUser $aclUser, ShopPost $shopPost): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(AclUser $aclUser, ShopPost $shopPost): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(AclUser $aclUser, ShopPost $shopPost): bool
    {
        //
    }
}
