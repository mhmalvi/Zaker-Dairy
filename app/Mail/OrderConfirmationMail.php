<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userInfo, $data)
    {
        $this->data = $data;
        $this->user = $userInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice Mail From Zaker Dairy')->view('mail.invoice');
    }
}
