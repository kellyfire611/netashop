<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AclUserHasRole;
use App\Models\AclRoleHasPermission;

class AclRole extends Model
{
    use HasFactory;

    protected $table = 'acl_roles';
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

    public function users() {
        return $this->hasMany(AclUserHasRole::class,
            'role_id', 'id');
    }
    
    public function permissions() {
        return $this->hasMany(AclRoleHasPermission::class,
            'role_id', 'id');
    }
}
