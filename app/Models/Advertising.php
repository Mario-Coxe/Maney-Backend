<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    use HasFactory;

    protected $table = "ads";
    protected $fillable = [
        'owner',
        'address',
        'status',
        'created_at',
        'updated_at',
    ];
}
