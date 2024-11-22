<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Exceptions\PaycardException;

class PaycardService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.paycard.api_key');
        $this->baseUrl = 'https://mapaycard.com';
    }

    public function createPayment(array $paymentData): array
    {
        if ($paymentData['amount'] <= 0) {
            throw new PaycardException('Amount must be greater than 0');
        }

        try {
            $response = Http::post($this->baseUrl . '/epay/create', [
                'c' => $this->apiKey,
                'paycard-amount' => $paymentData['amount'],
                'paycard-description' => $paymentData['description'],
                'paycard-operation-reference' => $paymentData['reference'] ?? null,
                'paycard-callback-url' => $paymentData['callback_url'] ?? null,
                'paycard-auto-redirect' => $paymentData['auto_redirect'] ? 'on' : 'off',
                'paycard-redirect-with-get' => $paymentData['redirect_with_get'] ? 'on' : 'off',
                'paycard-jump-to-paycard' => $paymentData['payment_method'] === 'PAYCARD' ? 'on' : null,
                'paycard-jump-to-cc' => $paymentData['payment_method'] === 'CREDIT_CARD' ? 'on' : null,
                'paycard-jump-to-om' => $paymentData['payment_method'] === 'ORANGE_MONEY' ? 'on' : null,
                'paycard-jump-to-momo' => $paymentData['payment_method'] === 'MOMO' ? 'on' : null,
            ]);

            $data = $response->json();
            
            if ($data['code'] !== 0) {
                throw new PaycardException($data['error_message'] ?? 'Unknown error');
            }

            return $data;
        } catch (\Exception $e) {
            throw new PaycardException('API call failed: ' . $e->getMessage());
        }
    }

    public function getPaymentStatus(string $reference): array
    {
        try {
            $response = Http::get($this->baseUrl . "/epay/{$this->apiKey}/{$reference}/status");
            $data = $response->json();

            if ($data['code'] !== 0) {
                throw new PaycardException($data['error_message'] ?? 'Unknown error');
            }

            return $data;
        } catch (\Exception $e) {
            throw new PaycardException('API call failed: ' . $e->getMessage());
        }
    }
}
