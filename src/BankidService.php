<?php

namespace BankID;

class BankidService
{

    // BankID /auth endpoint
    public function auth($endUserIp)
    {
        $apiVersion = '5.1';
        $bankidMethod = 'auth';
        $apiUrl = 'https://appapi2.test.bankid.com/rp/v' . $apiVersion . '/' . $bankidMethod;
        $personalNumber = '200001132380';
        $bodyParams = [
            'personalNumber' => $personalNumber,
            'endUserIp' => $endUserIp,
        ];

        $guzzleClient = new \GuzzleHttp\Client();

        try {
            $response = $guzzleClient->post($apiUrl, [
                'cert' => __DIR__ . '/certifications/FPTestcert4_20220818.pem',
                'verify' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($bodyParams)

            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            dd($response);
            $responseBodyAsString = $response->getBody()->getContents();
            return json_decode($responseBodyAsString, true);
        }
        return json_decode($response->getBody(), true);

    }

    // BankID /sign endpoint
    public function sign()
    {

    }

    // BankID /collect endpoint
    public function collect($orderRef)
    {

    }

    // BankID generate animated QR code string
    public function generateQRCode()
    {

    }

}