<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CandidaturaRicevuta extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $data,
        public string $cvPath
    ) {}

    public function build()
    {
        $subject = "Nuova candidatura - {$this->data['nome']} {$this->data['cognome']}";

        $fullPath = Storage::disk('local')->path($this->cvPath);

        return $this->subject($subject)
            ->view('emails.candidatura')
            ->with(['data' => $this->data])
            ->attach($fullPath, [
                'as' => $this->data['cv_original'] ?? 'cv.pdf',
            ]);
    }
}