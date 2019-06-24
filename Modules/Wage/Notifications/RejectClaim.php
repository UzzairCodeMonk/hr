<?php

namespace Modules\Wage\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Wage\Entities\Claim;
use Datakraf\User;
use Illuminate\Support\Facades\URL;

class RejectClaim extends Notification
{
    use Queueable;
    public $claim;
    public $user;
    public $rejecter;  

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Claim $claim, User $user,User $rejecter)
    {
        //
        $this->claim = $claim;
        $this->user = $user;  
        $this->rejecter = $rejecter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = URL::signedRoute('claimdetail.show', ['id' => $this->claim->id]);
        return (new MailMessage)
            ->subject('Your Application Claim Has Been Rejected')
            ->greeting('Your Application Claim Has Been Rejected')
            ->line('Applicant: ' . $this->claim->user->name)
            ->line('Claim Subject: '. $this->claim->subject)     
            ->line('Date Apply: '. $this->claim->created_at->format('d/m/Y')) 
            ->line('Amount: ' . $this->claim->amount)    
            ->line('Rejected by: '.$this->rejecter->name)
            ->action('View claim application', $link);
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
            'message' => $this->rejecter->name . ' has rejected your claim application',
            'claim_id' => $this->claim->id,
            'type' => 'claim'
        ];
    }
}
