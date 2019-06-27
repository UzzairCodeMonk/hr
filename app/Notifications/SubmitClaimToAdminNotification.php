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
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Claim $claim)
    {
        $this->claim = $claim;   
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
        // $link = URL::signedRoute('claimdetail.show', ['id' => $this->claim->id]);
        $link = route('claimdetail.show', ['id' => $this->claim->id]);
        return (new MailMessage)
            ->subject($this->claim->user->personalDetail->name. ' submitted a claim')
            ->greeting($this->claim->user->personalDetail->name. ' submitted a claim')
            ->line('Claim Subject: '. $this->claim->subject)     
            ->line('Date Apply: '. $this->claim->created_at->format('d/m/Y')) 
            ->line('Amount: ' . $this->claim->amount)                      
            ->action('View Claim', $link);
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->claim->user->id,
            'message' => $this->claim->user->personalDetail->name . ' has submitted a claim',
            // 'url' => URL::signedRoute('claimdetail.show', ['id' => $this->claim->id]),
            'url' => route('claimdetail.show', ['id' => $this->claim->id]),
            'type' => 'claim',
            'icon' => 'ti-file'
        ];
    }
}
