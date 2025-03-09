<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckOnline implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    //
    public function broadcastOn():Channel
    {
      //  return ['public'];
        return new Channel('online');
    }
    //
    public function broadcastAs(): string
    {
        return 'list';
    }
}