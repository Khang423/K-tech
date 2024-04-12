<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable= [
        'id',
        'name',
    ];

    public function member(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    use HasFactory;

}
