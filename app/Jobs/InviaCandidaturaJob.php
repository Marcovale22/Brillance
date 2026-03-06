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
use Illuminate\Support\Facades\Http;


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
        $fileFullPath = Storage::disk('local')->path($this->cvPath);

        $html = view('emails.candidatura', ['data' => $this->data])->render();

        $payload = [
            'sender' => [
                'name'  => env('BREVO_SENDER_NAME', 'Brillance'),
                'email' => env('BREVO_SENDER_EMAIL'),
            ],
            'to' => [
                ['email' => $this->toEmail],
            ],
            'subject' => 'Candidatura - ' . $this->data['nome'] . ' ' . $this->data['cognome'],
            'htmlContent' => $html,
            'attachment' => [
                [
                    'name' => $this->data['cv_original'] ?? basename($fileFullPath),
                    'content' => base64_encode(file_get_contents($fileFullPath)),
                ],
            ],
        ];

        /** @var \Illuminate\Http\Client\Response $response */
       $response = \Illuminate\Support\Facades\Http::withHeaders([
            'api-key' => env('BREVO_API_KEY'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', $payload);

        $response->throw();

        Storage::disk('local')->delete($this->cvPath);
    }
}