<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShopExport;
use App\Models\ShopImportDetail;

class ShopExportDetail extends Model
{
    use HasFactory;

    protected $table = 'shop_export_details';
    protected $fillable = [
        'export_id',
        'product_id',
        'quantity',
        'unit_price',
        'import_detail_id',
    ];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $dates = [];
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $timestamps = false;

    public function export() {
        return $this->belongsTo(ShopExport::class,
            'export_id', 'id');
    }

    // Xuất từ chi tiết nhập nào?
    public function import_detail() {
        return $this->belongsTo(ShopImportDetail::class,
            'import_detail_id', 'id');
    }
}
