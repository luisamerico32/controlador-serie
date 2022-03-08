<?php

namespace App\Events;

use App\Models\Serie;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventDeletedSeries
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var object
     */
    public $series;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(object $series)
    {
        $this->series = $series;
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
