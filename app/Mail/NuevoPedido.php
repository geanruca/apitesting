<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NuevoPedido extends Mailable
{
    public $pedido;
    public $user;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $pedido)
    {   
        $this->user   = $user;
        $this->pedido = $pedido;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user   = $this->user;
        $pedido = $this->pedido;
        return $this->from('contacto@aguaclean.app')
                    ->markdown('emails.notificaciones.NuevoPedido',compact('user','pedido'));
    }
}
