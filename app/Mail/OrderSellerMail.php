<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSellerMail extends Mailable
{
    use Queueable, SerializesModels;


    public $mailData;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email , $mailData)
    {
        $this->mailData = $mailData;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.order-seller');
    }
}
