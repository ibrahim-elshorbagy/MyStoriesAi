<?php

namespace App\Notifications\Orders\Status;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order\Order;

class PDFUploaded extends Notification
{

    protected $order;

    public function __construct(Order $order, $locale = null)
    {
        $this->order = $order;
        $this->locale = $locale ?: app()->getLocale();
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $locale = $this->locale;

        return (new MailMessage)
            ->subject(__('emails.pdf_uploaded_subject', ['id' => $this->order->id], $locale))
            ->view('emails.orders.status.pdf-uploaded', [
                'order' => $this->order,
                'notifiable' => $notifiable,
                'locale' => $locale
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'pdf_path' => $this->order->pdf_path,
        ];
    }
}
