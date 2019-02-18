<?php

namespace Datakraf\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Leave\Entities\Leave;
use Illuminate\Http\Request;
use Datakraf\User;
use Illuminate\Support\Facades\URL;


class RetractLeave extends Notification implements ShouldQueue
{
    use Queueable;

    public $leave;
    public $user;
    public $retractor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Leave $leave, User $user, User $retractor)
    {
        $this->leave = $leave;
        $this->user = $user;
        $this->retractor = $retractor;
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
        $link = URL::signedRoute('my-leave.show', ['id' => $this->leave->id]);
        return (new MailMessage)
            ->subject('The leave application has been withdrawn')
            ->greeting('The leave application has been withdrawn')
            ->line('Applicant: ' . $this->leave->user->name)
            ->line('Leave Type: ' . $this->leave->type->name)
            ->line('Start Date: ' . $this->leave->start_date)
            ->line('End Date: ' . $this->leave->end_date)
            ->line('Rejected by: ' . $this->rejecter->name)
            ->action('View Leave Application', $link);
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
            'message' => $this->retractor->name . ' has withdrawn this leave application',
            'leave_id' => $this->leave->id,
            'type' => 'leave'
        ];
    }
}
