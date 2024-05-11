<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtmCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function atms()
    {
        return $this->hasMany(Atm::class);
    }
}
