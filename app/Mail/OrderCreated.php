<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order, public bool $isAdmin = false)
    {
    }

    public function build(): self
    {
        $subject = $this->isAdmin
            ? 'Nuevo pedido recibido '.$this->order->codigo
            : 'Confirmación de pedido '.$this->order->codigo;

        return $this->subject($subject)
            ->view('emails.order-created')
            ->with([
                'order' => $this->order,
                'isAdmin' => $this->isAdmin,
            ]);
    }
}
