<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    public function municipe()
    {
        return $this->belongsTo(Municipe::class, 'id_municipe');
    }
    
}
