<?php

namespace Datakraf\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Datakraf\User;
use Modules\Wage\Entities\Payslip;
use Illuminate\Support\Facades\URL;

class PayslipGeneratedNotification extends Notification implements ShouldQueue
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
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = URL::signedRoute('payslip.my.record', [
            'id' => $this->payslip->user_id,
            'month' => $this->payslip->month,
            'year' => $this->payslip->year,
        ]);
        return (new MailMessage)
            ->greeting('Hi ' . $this->payslip->user->personalDetail->name . '!')
            ->line('Your ' . \getMonthNameBasedOnInt($this->payslip->month) . ' ' . $this->payslip->year . ' payslip is here!')
            ->action('View your payslip', $link);
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
            'message' => 'Your ' . \getMonthNameBasedOnInt($this->payslip->month) . ' ' . $this->payslip->year . ' payslip is here! Click to view.',
            'type' => 'payslip',
            'url' => URL::signedRoute('payslip.my.record', [
                'id' => $this->payslip->user_id,
                'month' => $this->payslip->month,
                'year' => $this->payslip->year,
            ]),
            'icon' => 'ti-money'
        ];
    }

}
