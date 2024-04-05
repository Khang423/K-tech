<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable= [
        'id',
        'name',
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    use HasFactory;

}
