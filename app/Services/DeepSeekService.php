<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class DeepSeekService
{
    protected $apiKey;
    protected $apiUrl = 'https://api.deepseek.com/chat/completions'; // URL sesuai dokumentasi

    public function __construct()
    {
        $this->apiKey = "###";
        if (empty($this->apiKey)) {
            throw new Exception($this->apiKey);
        }
    }

    public function generateResponse(string $userPrompt)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($this->apiUrl, [
                'model' => 'deepseek-chat',
                'messages' => [
                    [
                        'role' => 'system', 
                        'content' => 'Anda adalah asisten IT Support. Berikan saran singkat (maks 2 kalimat) dalam Bahasa Indonesia.'
                    ],
                    [
                        'role' => 'user', 
                        'content' => $userPrompt
                    ],
                ],
                'stream' => false,
                'max_tokens' => 100, // Batasi respons
            ]);

            // Handle error response
            if ($response->failed()) {
                \Log::error("DeepSeek API Error: " . $response->body());
                throw new Exception("API Error: " . $response->body());
            }

            $data = $response->json();
            return $data['choices'][0]['message']['content'] ?? 'Mohon hubungi IT Support.';

        } catch (Exception $e) {
            report($e); // Log error ke Laravel
            return "Silakan tunggu update dari tim terkait.";
        }
    }
}