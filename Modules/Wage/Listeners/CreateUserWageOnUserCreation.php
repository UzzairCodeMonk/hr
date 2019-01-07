<?php

namespace Modules\Wage\Listeners;

use Datakraf\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Modules\Wage\Entities\Wage;

class CreateUserWageOnUserCreation
{
    public $wage;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Wage $wage, Request $request)
    {
        $this->wage = $wage;
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $this->wage->create([
            'user_id' => $event->user->id,
            'wage' => $this->request->basic_salary
        ]);
    }
}
