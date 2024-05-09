<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
      'ward_id',
      'district_id',
      'city_id',
    ];
    use HasFactory;
}
