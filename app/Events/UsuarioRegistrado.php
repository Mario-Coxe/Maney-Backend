<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class UsuarioRegistrado implements ShouldBroadcast
{
    use SerializesModels;


    /**
     * Create a new event instance.
     */
    public function __construct()
    {
    }
    public function broadcastAs(){
        return 'registrado';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('private.registrado.'. 1),
        ];
    }
}
