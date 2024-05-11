<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NovaNotificacao implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $mensagem;

    public function __construct($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function broadcastOn()
    {
        return new Channel('notificacoes');
    }

    public function broadcastAs(){
        return 'notificacoes';
    }
}
