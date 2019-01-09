<?php

namespace Datakraf\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Datakraf\Notifications\UserCreatedNotification;
use Datakraf\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Datakraf\Events\UserCreated;

class SendEmailOnUserCreation
{
    public $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $event->user->notify(new UserCreatedNotification());
    }
}
