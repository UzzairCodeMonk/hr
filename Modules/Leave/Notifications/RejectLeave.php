<?php

namespace Modules\Leave\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Leave\Entities\Leave;
use Datakraf\User;

class RejectLeave extends Notification
{
    use Queueable;

    public $leave;
    public $user;
    public $notifier;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Leave $leave, User $user, User $notifier)
    {
        $this->leave = $leave;
        $this->user = $user;
        $this->notifier = $notifier;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Application Leave')
            ->line('Applicant: ' . $this->leave->user->name)
            ->line('Leave Type: ' . $this->leave->type->name)
            ->line('Start Date: ' . $this->leave->start_date)
            ->line('End Date: ' . $this->leave->end_date)
            ->action('Approve', url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'message' => $this->leave->user->name . ' has rejected your leave application',
            'leave_id' => $this->leave->id,
            'type' => 'leave'
        ];
    }
}
