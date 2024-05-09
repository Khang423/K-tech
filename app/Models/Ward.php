<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ward extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];
    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
    public function supplier(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }
    use HasFactory;
}
