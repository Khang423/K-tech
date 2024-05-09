<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable =[
        'id',
        'name',
        'phone',
        'email',
        'address',
        'wards_id',
        'district_id',
        'city_id',
        ];
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class,'wards_id','id');
    }

    public function ware(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }
    use HasFactory;
}
