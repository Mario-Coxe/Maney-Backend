<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipe extends Model
{
    use HasFactory;

    public $timestamps = false; // Adicione essa linha para desativar os timestamps

    protected $fillable = [
        'name',
        'id_provincia'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province');
    }

}
