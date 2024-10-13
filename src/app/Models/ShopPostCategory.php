<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPostCategory extends Model
{
    use HasFactory;

    protected $table = 'shop_post_categories';
    protected $fillable = [
        'post_category_code',
        'post_category_name',
        'description',
        'image',
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
}
