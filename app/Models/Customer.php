<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{

    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'gender',
        'birthdate',
        'avatar',
        'username',
        'password',
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
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    use HasFactory;
}