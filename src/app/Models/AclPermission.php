<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AclRoleHasPermission;
use App\Models\AclUserHasPermission;

class AclPermission extends Model
{
    use HasFactory;

    protected $table = 'acl_permissions';
    protected $fillable = [
        'name',
        'display_name',
        'guard_name',
        'created_at',
        'updated_at',
    ];
    protected $guard = ['id'];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function roles() {
        return $this->hasMany(AclRoleHasPermission::class,
            'permission_id', 'id');
    }

    public function users() {
        return $this->hasMany(AclUserHasPermission::class,
            'permission_id', 'id');
    }
}
