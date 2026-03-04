<?php

namespace App\Jobs;

use App\Mail\RichiestaPreventivo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

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
        Mail::to($this->toEmail)->send(new RichiestaPreventivo($this->data));
    }
}