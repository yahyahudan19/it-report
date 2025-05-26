<?php

namespace App\Jobs;

use App\Services\WhatsappService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsappNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $number;
    protected string $message;

    public function __construct(string $number, string $message)
    {
        $this->number = $number;
        $this->message = $message;
    }

    public function handle(): void
    {
        WhatsappService::sendText([
            'to' => $this->number,
            'message' => $this->message,
        ]);
    }
}

