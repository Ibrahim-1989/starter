<?php

namespace App\Events;

use App\Models\video;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoViewer
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $videoProp;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(video $video)
    {
        $this->videoProp = $video;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
