<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductDetail extends Model
{
    protected $fillable = [
      'product_id',
      'graphic_card',
      'cpu',
      'ram',
      'ram_type',
      'ram_slot',
      'ssd',
      'touchscreen',
      'bg_plate',
      'scan_frequency',
      'screen_size',
      'screen_resolution',
      'screen_tech',
      'keyboard_light',
      'webcam',
      'operating_system',
      'bluetooth',
      'wifi',
      'audio_tech',
      'security',
      'connectivity',
      'describe',
      'weight',
      'battery',
      'cooling_system',
      'color',
      'material',
      'dimension',
      'release_date',
    ];

}
