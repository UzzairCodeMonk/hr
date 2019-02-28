<?php

namespace Datakraf\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Wage\Entities\Claim;
use Illuminate\Http\Request;
use Datakraf\User;
use Illuminate\Support\Facades\URL;

class SubmitClaimToAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $claim;
    public $user;    
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
        return ['mail','database'];
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
            ->subject($this->user->personalDetail->name. ' submitted a claim')
            ->greeting($this->user->personalDetail->name. ' submitted a claim')
            ->line('Submitter: ' . $this->claim->user->name)
            ->line('Claim Type: ' . $this->claim->type->name)
            ->line('Amount: ' . $this->claim->amount)
            ->line('Remarks: ' . $this->claim->remarks)            
            ->action('View Claim', $link);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
