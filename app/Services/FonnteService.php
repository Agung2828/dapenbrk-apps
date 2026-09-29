<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    public static function sendMessage(string $phone, string $message): bool
    {
        $token  = config('services.fonnte.token');
        $target = self::formatPhone($phone);

        if (empty($target)) {
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->asForm()->post('https://api.fonnte.com/send', [
                'target'  => $target,
                'message' => $message,
            ]);

            if ($response->failed()) {
                Log::error('Fonnte WA gagal terkirim (HTTP error)', [
                    'target'   => $target,
                    'response' => $response->body(),
                ]);
                return false;
            }

            $data = $response->json();

            if (isset($data['status']) && $data['status'] === false) {
                Log::error('Fonnte WA response menyatakan gagal', $data);
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('Fonnte exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Ubah 08xxxxxxxxxx / +62xxxxxxxxxx / 62xxxxxxxxxx
     * menjadi format 62xxxxxxxxxx yang dibutuhkan Fonnte.
     */
    public static function formatPhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (empty($phone)) {
            return '';
        }

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }

        return $phone;
    }
}
