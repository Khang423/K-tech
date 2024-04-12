<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class,'roles_id','id');
    }
    use HasFactory;
}
