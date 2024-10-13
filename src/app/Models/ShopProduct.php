<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShopProductImage;
use App\Models\ShopProductDiscount;
use App\Models\ShopCategory;
use App\Models\ShopSupplier;

class ShopProduct extends Model
{
    use HasFactory;

    protected $table = 'shop_products';
    protected $fillable = [
        'product_code',
        'product_name',
        'image',
        'short_description',
        'description',
        'standard_cost',
        'list_price',
        'quantity_per_unit',
        'discontinuted',
        'is_featured',
        'is_new',
        'category_id',
        'supplier_id',
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

    public function images() {
        return $this->hasMany(ShopProductImage::class,
            'product_id', 'id');
    }

    public function discounts() {
        return $this->hasMany(ShopProductDiscount::class,
            'product_id', 'id');
    }

    public function category() {
        return $this->belongsTo(ShopCategory::class,
            'category_id', 'id');
    }

    public function supplier() {
        return $this->belongsTo(ShopSupplier::class,
            'supplier_id', 'id');
    }
}
