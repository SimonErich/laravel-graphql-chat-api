<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class TestBroadcastCreated implements ShouldBroadcast
{
    use SerializesModels, Dispatchable;

    /**
     * Just a random string to see whether it works or not
     */
    public $test = '';

    /**
     * Create a new event instance.
     * 
     * @param string $msg
     *
     * @return void
     */
    public function __construct($msg = 'Everything working')
    {
        $this->test = $msg;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('test');
    }
}