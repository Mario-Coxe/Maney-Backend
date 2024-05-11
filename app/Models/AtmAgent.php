<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtmAgent extends Model
{
    use HasFactory;
    protected $table = "atm_agents";
    protected $fillable = [
        'id',
        'atm_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming the foreign key is user_id
    }
  

}
