<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $restaurant_name;
    public $total = 0;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_order, $_restaurant_name)
    {
        $this->order = $_order;
        $this->restaurant_name = $_restaurant_name;
        foreach ($this->order->products as $product) {
            $this->total += $product->price * $product->pivot->quantity;
        }
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(

            replyTo: $this->order->email,
            subject: 'Email di conferma Ordine',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.client-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}