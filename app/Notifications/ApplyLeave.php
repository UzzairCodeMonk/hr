<?php

namespace Datakraf\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Leave\Entities\Leave;
use Datakraf\User;
use Illuminate\Support\Facades\URL;

class ApplyLeave extends Notification implements ShouldQueue
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
    public function __construct(Leave $leave, User $user)
    {
        $this->leave = $leave;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = URL::signedRoute('leave.employee.show', ['id' => $this->leave->id]);

        return (new MailMessage)
            ->subject('Leave Application: ' . $this->leave->user->name)
            ->greeting($this->leave->user->name . ' has applied for leave')
            ->line('Applicant: ' . $this->leave->user->name)
            ->line('Leave Type: ' . $this->leave->type->name)
            ->line('Start Date: ' . $this->leave->start_date)
            ->line('End Date: ' . $this->leave->end_date)
            ->action('View leave application', $link);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'message' => $this->leave->user->name . ' has submitted application leave',
            'leave_id' => $this->leave->id,
            'type' => 'leave'
        ];
    }
}
