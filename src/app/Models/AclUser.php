<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AclUserHasRole;
use App\Models\AclUserHasPermission;
use App\Models\ShopPost;

class AclUser extends Model
{
    use HasFactory;

    protected $table = 'acl_users';
    protected $fillable = [
        'username',
        'last_name',
        'first_name',
        'gender',
        'email',
        'birthday',
        'avatar',
        'code',
        'job_title',
        'department',
        'manager_id',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'postal_code',
        'country',
        'active_code',
        'status',
        'created_at',
        'updated_at',
    ];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $dates = [
        'birthday',
        'created_at',
        'updated_at',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function roles() {
        return $this->hasMany(AclUserHasRole::class,
            'user_id', 'id');
    }

    public function permissions() {
        return $this->hasMany(AclUserHasPermission::class,
            'user_id', 'id');
    }

    public function posts() {
        return $this->hasMany(ShopPost::class,
            'user_id', 'id');
    }
}
