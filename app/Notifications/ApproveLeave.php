<?php

namespace Datakraf\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Leave\Entities\Leave;
use Illuminate\Support\Facades\URL;
use Datakraf\User;

class ApproveLeave extends Notification implements ShouldQueue
{
    use Queueable;

    public $leave;
    public $user;
    public $approver;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Leave $leave, User $user, User $approver)
    {
        $this->leave = $leave;
        $this->user = $user;
        $this->approver = $approver;
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
    $link = URL::signedRoute('leave.show', ['id' => $this->leave->id]);
        return (new MailMessage)
            ->subject('Your Application Leave Has Been Approved')
            ->greeting('Your Application Leave Has Been Approved')
            ->line('Applicant: ' . $this->leave->user->name)
            ->line('Leave Type: ' . $this->leave->type->name)
            ->line('Start Date: ' . $this->leave->start_date)
            ->line('End Date: ' . $this->leave->end_date)
            ->line('Approved by: ' . $this->approver->name)
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
            'message' => $this->approver->name . ' has approved your leave application',
            'leave_id' => $this->leave->id,
            'type' => 'leave',
            'url' => URL::signedRoute('leave.show', ['id' => $this->leave->id]),
            'icon' => 'ti-files'
        ];
    }
}
