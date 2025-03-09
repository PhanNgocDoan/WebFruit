<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckAdminJoinGroupChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public int $adminId;
    public int $groupId;
    
    public function __construct(int $adminId,int $groupId)
    {
        $this->adminId = $adminId;
        $this->groupId = $groupId;
    }
    //
    public function broadcastOn():Channel
    {
      //  return ['public'];
        return new Channel('adminInGroup'.$this->groupId);
    }

    public function broadcastAs(): string
    {
        return 'online';
    }
}