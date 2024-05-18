<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Veiculo;
use App\Models\SolicitacaoServico;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $table = "users";
    protected $fillable = [
        'name',
        'phone',
        'password',
        'tipo_usuario',
        'ativo',
        'ultima_atividade',
        'foto'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'ativo' => 'boolean',
    ];

}
