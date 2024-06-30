<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    use HasFactory;

    protected $table = "banks";
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    public function atms()
    {
        return $this->hasMany(Atm::class, 'bank_id');
    }
}
