<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificaClienteMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $object;

    public function __construct($object) {
        $this->object = $object;
    }

    /**
     * Create a new message instance.
     *
     * @return void
     */

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail')
        ->with([
            'name' => $this->object['name'],
            'messages'=> $this->object['message']
        ])
        ->subject('informações de atividade');
                    
    }
}
