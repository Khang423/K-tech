<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warehouse extends Model
{
    protected $fillable =[
        'id',
        'product_id',
        'supplier_id',
        'stock_quantity',
        'price',
        'name',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    use HasFactory;
}
