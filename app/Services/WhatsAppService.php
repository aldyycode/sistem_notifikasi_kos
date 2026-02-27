<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    public function send($nomor, $pesan)
    {
        $response = Http::withHeaders([
            'Authorization' => env('WA_TOKEN')
        ])->post(env('WA_URL'), [
            'target' => $nomor,
            'message' => $pesan,
        ]);

        return $response->json();
    }
}