<?php

namespace App\Notifications;

use App\Models\Invoices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Mail;


class AddInvoices extends Notification
{
    use Queueable;
    private $invoice_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice_id)
    {
        $this->$invoice_id = $invoice_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $url="http://127.0.0.1:8000/invoices_details".$this->invoice_id ;
        return (new MailMessage)
                    ->subject('إضافة فاتورة جديدة')
//                    ->lineIf($this->amount > 0, "Amount paid: {$this->amount}")
                    ->line('إضافة فاتورة جديدة')
                    ->action('  عرض الفاتوره ', $url)
                    ->line('شـــــــــــــكرا لاستخدامك هذه الخدمة');
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
