<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class CandidaturaRicevuta extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;
    public UploadedFile $cv;

    public function __construct(array $data, UploadedFile $cv)
    {
        $this->data = $data;
        $this->cv = $cv;
    }

    public function build()
    {
        $subject = "Nuova candidatura - {$this->data['nome']} {$this->data['cognome']}";

        return $this->subject($subject)
            // QUESTA deve essere la blade dell'email, non la pagina della form
            ->view('partials.emails')
            // passa i dati alla blade email
            ->with(['data' => $this->data])
            // allegato senza salvare nulla
            ->attach($this->cv->getRealPath(), [
                'as' => $this->cv->getClientOriginalName(),
                'mime' => $this->cv->getMimeType(),
            ]);
    }
}