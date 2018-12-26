<?php

namespace Modules\Leave\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Leave\Entities\LeaveEntitlement;
use Datakraf\Events\UserCreated;

class CreateLeaveEntitlement
{
    public $leave;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LeaveEntitlement $leave)
    {
        $this->leave = $leave;
    }

    /**
     * Handle the event.
     *
     * @param =UserCreated $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $this->leave->create([
            'user_id' => $event->user->id,
            'days' => 14,
        ]);
    }
}
