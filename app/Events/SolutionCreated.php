<?php

namespace App\Events;

use App\Solution;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class SolutionCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $solution; 
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Solution $solution)
    {
        $this->solution = $solution;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('solutions');
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $array = $this->solution->toArray();
        unset($array['data']);
        return $array;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    // public function broadcastAs()
    // {
    //     return 'SolutionCreated';
    // }        
}
