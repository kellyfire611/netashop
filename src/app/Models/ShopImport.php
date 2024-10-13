<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShopStore;
use App\Models\ShopImportDetail;

class ShopImport extends Model
{
    use HasFactory;

    protected $table = 'shop_imports';
    protected $fillable = [
        'store_id',
        'employee_id',
        'import_date',
        'description',
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

    public function store() {
        return $this->belongsTo(ShopStore::class,
            'store_id', 'id');
    }

    public function import_details() {
        return $this->hasMany(ShopImportDetail::class,
            'product_id', 'id');
    }
}
