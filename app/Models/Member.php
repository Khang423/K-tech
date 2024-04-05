<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'username',
        'password',
        'roles_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    use HasFactory;
}
