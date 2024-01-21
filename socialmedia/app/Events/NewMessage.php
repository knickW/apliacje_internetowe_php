<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Message  $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Określ kanał lub kanały, na których ma być przekazywane zdarzenie
        $channels = [
            new PrivateChannel("private-chat.{$this->message->receiver_id}"),
            new PrivateChannel("private-chat.{$this->message->sender_id}"),
        ];

        // Dodaj kanały grupowe, jeśli wiadomość dotyczy grupy
        if ($this->message->group_id) {
            $channels[] = new PresenceChannel("group-chat.{$this->message->group_id}");
        }

        return $channels;
    }
}

