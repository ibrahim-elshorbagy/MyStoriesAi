<?php

namespace App\Notifications\Orders\Creating;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order\Order;

class OrderConfirmation extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $locale = app()->getLocale();

        return (new MailMessage)
            ->subject(__('emails.order_confirmation_subject', ['id' => $this->order->id], $locale))
            ->view('emails.orders.creating.user-confirmation', [
                'order' => $this->order,
                'notifiable' => $notifiable,
                'locale' => $locale
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'total_price' => $this->order->total_price,
        ];
    }
}
