<?php

namespace BankID;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BankidService
{
    private Bankid $bankid;
    private Client $client;

    public function __construct(string $environment, float $apiVersion)
    {
        $this->bankid = new Bankid($environment, $apiVersion);

        $this->client = new Client([
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function auth(string $endUserIp, ?string $personalNumber = null)
    {
        $bodyParameters = [
            'endUserIp' => $endUserIp,
        ];

        if ($personalNumber !== null) {
            $bodyParameters['personalNumber'] = $personalNumber;
        }

        return $this->getResponse($this->bankid->getAuthUrl(), $bodyParameters);
    }

    public function sign(string $endUserIp, string $personalNumber, string $userVisibleData)
    {
        $bodyParameters = [
            'personalNumber' => $personalNumber,
            'endUserIp' => $endUserIp,
            'userVisibleData' => base64_encode($userVisibleData),
        ];

        return $this->getResponse($this->bankid->getSignUrl(), $bodyParameters);
    }

    public function collect(string $orderRef)
    {
        $bodyParameters = [
            'orderRef' => $orderRef,
        ];

        return $this->getResponse($this->bankid->getCollectUrl(), $bodyParameters);
    }

    private function getResponse(string $url, array $bodyParameters)
    {
        try {
            $response = $this->client->post($url, [
                'cert' => Bankid::BANKID_TEST_CERTIFICATION_20220818,
                'body' => json_encode($bodyParameters),
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return json_decode($responseBodyAsString, true);
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    public function generateQRCodeText(string $qrStartToken, string $qrStartSecret)
    {
        $prefix = 'bankid';
        $time = time() - 1; // Subtract 1 second to ensure the first code is valid
        $qrAuthCode = hash_hmac('sha256', $qrStartSecret, $time);

        return "{$prefix}.{$qrStartToken}.{$time}.{$qrAuthCode}";
    }
}
