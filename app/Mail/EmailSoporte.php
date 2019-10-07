<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSoporte extends Mailable
{
    public $soporte;
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($soporte)
    {
        $this->soporte = $soporte;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $soporte = $this->soporte;
        return $this->replyTo($soporte->email)
        ->subject("Ticket Soporte:".$soporte->id.": $soporte->nombre")
        ->view('emails.MobileChile.Soporte');
    }
}
