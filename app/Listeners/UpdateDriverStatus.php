<?php
namespace App\Listeners;

use App\Events\TokenExpired;

class UpdateDriverStatus
{
    public function handle(TokenExpired $event)
    {
        $motorista = $event->user;

        // Defina o motorista como inativo
        $motorista->update(['ativo' => false]);
    }
}
