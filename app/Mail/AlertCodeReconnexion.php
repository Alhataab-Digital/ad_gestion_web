<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlertCodeReconnexion extends Mailable
{
    use Queueable, SerializesModels;

    public $code1;
    /**
     * Create a new message instance.
     */
    public function __construct($code)
    {
        $this->code1=$code;
    }



    public function build()
    {
        return $this->view('email.alert_compte')
                    ->with('details', $this->code1);
    }
}
