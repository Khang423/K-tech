<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $fillable = [
      'order_id',
      'product_id',
      'quantity',
      'price',
    ];
    use HasFactory;
}
