<?php

namespace Modules\Wage\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Datakraf\User;
use Modules\Wage\Entities\Payslip;

class PayslipGenerated extends Notification
{
    use Queueable;  

    public $payslip;    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payslip $payslip)
    {        
        $this->payslip = $payslip;        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', 'https://laravel.com')
            ->line('Thank you for using our application!');
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
            'user_id' => $this->payslip->user_id,
            'month' => $this->payslip->month,
            'year' => $this->payslip->year,
            'message' => 'Your '.\getMonthNameBasedOnInt($this->payslip->month).' '.$this->payslip->year.' payslip is here! Click to view.',            
            'type' => 'payslip'
        ];
    }


}
