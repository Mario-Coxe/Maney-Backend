<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\SolicitacaoServico;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
Broadcast::routes(['middleware' => ['auth:sanctum']]);
//Broadcast::routes();
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('private.solicitacao.status.{solicitacaoId}', function ($user, $solicitacaoId) {
    // Verificar se o usuário é um motorista válido e se está relacionado à corrida
    return $user->tipo_usuario === 'cliente' && $user->solicitacoes_cliente->contains(SolicitacaoServico::find($solicitacaoId));
});

Broadcast::channel('notificacoes', function ($user) {
    return $user->tipo_usuario === 'cliente';
});

Broadcast::channel('private.motorista.location.{solicitacaoId}', function ($user, $solicitacaoId) {
    return $user->tipo_usuario === 'cliente' && $user->solicitacoes_cliente->contains(SolicitacaoServico::find($solicitacaoId));
});



