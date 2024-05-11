<?php
namespace App\Http\Controllers;
use App\Events\NovaNotificacao;
use Illuminate\Http\Request;
class MyNotificacaoController extends Controller
{
    public function sendPushNotification(Request $request)
    {
        $this->validate($request, [
            'mensagem' => 'required|string|max:50',

        ]);

        event(new NovaNotificacao($request->mensagem));

        return response()->json(['message' => 'Notificação enviada com sucesso']);
    }
}
