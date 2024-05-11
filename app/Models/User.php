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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'ativo' => 'boolean',
    ];

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }

    public function solicitacoes_motorista()
    {
        return $this->hasMany(SolicitacaoServico::class, 'motorista_id');
    }

    public function solicitacoes_cliente()
    {
        return $this->hasMany(SolicitacaoServico::class, 'cliente_id');
    }

    public function enderecoUser()
    {
        return $this->hasOne(EnderecoUser::class,'usuario_id');
    }

    public function isDriverActive()
    {
        return $this->tipo_usuario === 'motorista' && $this->ativo == true;
    }

    public function updateStatus()
    {
        // Your code here
    }
}
