<?php

namespace App\Jobs;

use App\Mail\RichiestaPreventivo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class InviaPreventivoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 10;

    public function __construct(
        public array $data,
        public string $toEmail
    ) {}

    public function handle(): void
    {
        $html = view('emails.preventivo', ['data' => $this->data])->render();

        $subject = 'Richiesta preventivo - ' .
            ($this->data['servizio'] ?? '-') .
            ' (' . ($this->data['zona'] ?? '-') . ')';

        $payload = [
            'sender' => [
                'name'  => env('BREVO_SENDER_NAME', 'Brillance'),
                'email' => env('BREVO_SENDER_EMAIL'),
            ],
            'to' => [
                ['email' => $this->toEmail],
            ],
            'subject' => $subject,
            'htmlContent' => $html,
        ];

        /** @var \Illuminate\Http\Client\Response $response */
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'api-key' => env('BREVO_API_KEY'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', $payload);

        $response->throw();
    }
}