<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShopCustomerVoucher;
use App\Models\ShopProductVoucher;

class ShopVoucher extends Model
{
    use HasFactory;

    protected $table = 'shop_vouchers';
    protected $fillable = [
        'voucher_code',
        'voucher_name',
        'description',
        'uses',
        'max_uses',
        'max_uses_user',
        'type',
        'is_fixed',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function customers() {
        return $this->hasMany(ShopCustomerVoucher::class,
            'voucher_id', 'id');
    }

    public function products() {
        return $this->hasMany(ShopProductVoucher::class,
            'voucher_id', 'id');
    }
}
