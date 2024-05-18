<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Atm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'address',
        'has_cash',
        'has_paper',
        'status'
    ];


    public function category()
    {
        return $this->belongsTo(AtmCategory::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class, 'id_street');
    }

    public function municipe()
    {
       return $this->belongsTo(Municipe::class, 'id_municipe' ); // 'municipe' é o nome da coluna de relacionamento em atms
    }


}
