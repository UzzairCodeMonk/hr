<?php

namespace Modules\Profile\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Profile\Entities\PersonalDetail;

class PersonalDetailCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $personalDetail;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PersonalDetail $personalDetail)
    {
        $this->personalDetail = $personalDetail;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
