<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

        public Order $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // // public function __construct($order, $fname)
    // {
    //     //
    //     $this->order = $order;
    //     $this->fname = $order->user->fname;
    // }
    public function __construct($order)
{
    $this->order = $order;

}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order_confirm')->text('emails.order_confirm');
        ;
    }
}
