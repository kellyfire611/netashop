<?php

namespace App\Policies;

use App\Models\AclUser;
use Illuminate\Auth\Access\Response;

class AclUserPolicy
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
    public function view(AclUser $aclUser, AclUser $aclUser2): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(AclUser $aclUser): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(AclUser $aclUser, AclUser $aclUser2): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(AclUser $aclUser, AclUser $aclUser2): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(AclUser $aclUser, AclUser $aclUser2): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(AclUser $aclUser, AclUser $aclUser2): bool
    {
        //
    }
}
