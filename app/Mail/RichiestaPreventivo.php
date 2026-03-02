<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RichiestaPreventivo extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $subject = "Richiesta preventivo - {$this->data['servizio']} ({$this->data['zona']})";

        return $this->subject($subject)
            ->view('emails.preventivo')
            ->with(['data' => $this->data]);
    }
}