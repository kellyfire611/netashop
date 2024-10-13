<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShopVoucher;

class ShopProductVoucher extends Model
{
    use HasFactory;

    protected $table = 'shop_product_voucher';
    protected $fillable = [
        'product_id',
        'voucher_id',
        'created_at',
        'updated_at',
    ];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function voucher() {
        return $this->belongsTo(ShopVoucher::class,
            'voucher_id', 'id');
    }
}
