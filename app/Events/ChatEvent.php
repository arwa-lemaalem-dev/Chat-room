<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $from_user;
    public $to_user;
    public $offre;
    public $idoffre;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,User $from_user,User $to_user,$offre,$id)
    {
        $this->message=$message;
        $this->from_user=$from_user;
        $this->to_user=$to_user;
        $this->offre=$offre;
        $this->idoffre=$id;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat_room');
    }
}
