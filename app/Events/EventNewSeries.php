<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventNewSeries
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $name;
    /**
     * @var int
     */
    public $seasons;
    /**
     * @var int
     */
    public $episodes;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $name, int $seasons, int $episodes)
    {
        $this->name = $name;
        $this->seasons = $seasons;
        $this->episodes = $episodes;
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
