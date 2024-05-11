<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historie extends Model
{
    use HasFactory;
    protected $table = "histories";
    protected $fillable = [
        'agent_id',
        'name',
        'address',
        'has_cash',
        'has_paper' ,
        'created_at',
        'updated_at',
        'logo'  

    ];
}
