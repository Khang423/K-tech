<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'id',
        'member_id',
        'brand_id',
        'category_id',
        'name',
        'price',
        'outsite_image',
    ];
    public function ware(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }
    use HasFactory;
}
