<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAccounts extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public function __construct(array $details)
    {
        //
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("delivgo.stuff@gmail.com")->view("emails.newAccount", ["details" => $this->details]);
    }
}
