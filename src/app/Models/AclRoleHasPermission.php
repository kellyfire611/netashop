<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AclRole;
use App\Models\AclPermission;

class AclRoleHasPermission extends Model
{
    use HasFactory;

    protected $table = 'acl_role_has_permissions';
    protected $fillable = [
        'role_id',
        'permission_id',
    ];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $dates = [];
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;

    // relationship
    public function role() {
        return $this->belongsTo(AclRole::class,
            'role_id', 'id');
    }
    public function permission() {
        return $this->belongsTo(AclPermission::class,
            'permission_id', 'id');
    }
}
