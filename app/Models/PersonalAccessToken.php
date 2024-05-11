<?php

namespace App\Models;
use Laravel\Sanctum\PersonalAccessToken as Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Models
{
    use HasFactory;

    protected $casts = [
        'abilities' => 'json',
        'last_used_at' => 'datetime',
        'expired_at' => 'datetime'
    ];

    protected $fillable = [
        'name',
        'token',
        'abilities',
        'expired_at'
    ];
}
