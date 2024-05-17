<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
      'id',
      'customer_id',
      'receive_name',
      'receive_phone',
      'status',
      'total_price',
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
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    use HasFactory;

}
