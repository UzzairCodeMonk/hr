<?php

namespace Datakraf\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Datakraf\User;
use Illuminate\Support\Facades\URL;
use Modules\Wage\Entities\Claim;

class SubmitClaim extends Notification implements ShouldQueue
{
    use Queueable;

    public $claim;
    public $user;
    public $notifier;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Claim $claim, User $user)
    {
        $this->claim = $claim;
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
        $link = URL::signedRoute('claim.show', ['id' => $this->claim->id]);

        return (new MailMessage)
            ->subject('Claim: ' . $this->claim->user->name)
            ->greeting($this->claim->user->name . ' has applied for claim')
            ->line('Applicant: ' . $this->claim->user->name)
            ->line('Claim Type: ' . $this->claim->type->name)
            ->line('Submission Date: ' . $this->claim->created_at)
            ->line('Amount: ' . $this->claim->amount)
            ->action('View claim application', $link);
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
            'message' => $this->claim->user->name . ' has submitted a claim',
            'claim_id' => $this->claim->id,
            'type' => 'claim',
            'url' => URL::signedRoute('claim.show', ['id' => $this->claim->id]),
            'icon' => 'ti-files'
        ];
    }
}
