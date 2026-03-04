<?php

namespace App\Jobs;

use App\Mail\CandidaturaRicevuta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InviaCandidaturaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public array $data,
        public string $cvPath,
        public string $toEmail
    ) {}

    public function handle(): void
    {
        Mail::to($this->toEmail)->send(new CandidaturaRicevuta($this->data, $this->cvPath));

        // cancella il file dopo l'invio
        Storage::disk('local')->delete($this->cvPath);
    }
}