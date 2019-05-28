<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NuevoCliente extends Mailable
{
    public $contacto;
    public $otros;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contacto,$otros)
    {
        $this->contacto = $contacto;
        $this->otros = $otros;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $contacto = $this->contacto;
        $otros = $this->otros;
        return $this->markdown('emails.MobileChile.NuevoCliente',compact($contacto,$otros));
    }
}
