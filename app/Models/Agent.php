<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Agent extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $table = "agents";
    protected $fillable = [
        'nome',
        'phone',
        'password',
        'address',
        'created_at',
        'updated_at',
        'servico',
    ];
}
