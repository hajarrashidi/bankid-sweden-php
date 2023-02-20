<?php

namespace BankID;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BankidService
{
    private $apiVersion = '5.1';
    private $baseUrl = 'https://appapi2.test.bankid.com/rp/v';

    private $certPath = __DIR__ . '/certifications/FPTestcert4_20220818.pem';

    public function auth($endUserIp)
    {
        $url = $this->baseUrl . $this->apiVersion . '/auth';

        $params = [
            'personalNumber' => '200001132380',
            'endUserIp' => $endUserIp,
        ];

        return $this->makeRequest($url, $params);
    }

    public function sign()
    {
        // This endpoint is not prioritized right now.
    }

    public function collect($orderRef)
    {
        $url = $this->baseUrl . $this->apiVersion . '/collect';

        $params = [
            'orderRef' => $orderRef,
        ];

        return $this->makeRequest($url, $params);
    }

    public function generateQRCode()
    {
        // BankID generate animated QR code string
    }

    private function makeRequest(string $url, array $bodyParameters)
    {
        $client = new Client();

        try {
            $response = $client->post($url, [
                'cert' => $this->certPath,
                'verify' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($bodyParameters)
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            dd($response);
            $responseBodyAsString = $response->getBody()->getContents();
            return json_decode($responseBodyAsString, true);
        }

        return json_decode($response->getBody(), true);
    }
}
