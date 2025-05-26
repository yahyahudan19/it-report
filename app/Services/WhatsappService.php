<?php

namespace App\Services;

use App\Models\Whatsapp;
use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public static function sendText(array $data): bool
    {
        $config = Whatsapp::where('status', 'enable')->first();
        if (!$config || empty($data['to']) || empty($data['message'])) return false;

        $payload = [
            'api_key' => $config->api_key,
            'sender' => $config->number,
            'number' => $data['to'],
            'message' => $data['message'],
        ];

        $endpoint = rtrim($config->endpoint, '/') . '/send-message';

        try {
            $response = Http::post($endpoint, $payload);
            return $response->successful();
        } catch (\Exception $e) {
            \Log::error('WA Error: ' . $e->getMessage());
            return false;
        }
    }

}
