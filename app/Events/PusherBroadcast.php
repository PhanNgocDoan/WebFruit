<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public int $chater1;
    public int $chater2;

    public function __construct(string $message,int $chater1,int $chater2)
    {
        $this->message = $message;
        $this->chater1 = $chater1;
        $this->chater2 = $chater2;
    }
    public function broadcastOn():Channel
    {
      //  return ['public'];
        return new Channel($this->chater1.'and'.$this->chater2);
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}