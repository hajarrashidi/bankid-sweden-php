<?php

namespace BankID;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BankidService
{
    private const API_VERSION = '5.1';
    private const BASE_URL = 'https://appapi2.test.bankid.com/rp/v';

    private const ENDPOINT_AUTH = '/auth';
    private const ENDPOINT_SIGN = '/sign';
    private const ENDPOINT_COLLECT = '/collect';
    private const BANKID_TEST_CERTIFICATION_20220818 = __DIR__ . '/certifications/FPTestcert4_20220818.pem';

    public function auth($endUserIp)
    {
        $url = self::BASE_URL . self::API_VERSION . self::ENDPOINT_AUTH;

        $bodyParameters = [
            'personalNumber' => '200001132380',
            'endUserIp' => $endUserIp,
        ];

        return $this->getResponse($url, $bodyParameters);
    }

    public function sign($endUserIp)
    {
        $url = self::BASE_URL . self::API_VERSION . self::ENDPOINT_SIGN;

        $bodyParameters = [
            'personalNumber' => '200001132380',
            'endUserIp' => $endUserIp,
            'userVisibleData' => base64_encode('Hello World!')
        ];

        return $this->getResponse($url, $bodyParameters);
    }

    public function collect($orderRef)
    {
        $url = self::BASE_URL . self::API_VERSION . self::ENDPOINT_COLLECT;

        $bodyParameters = [
            'orderRef' => $orderRef,
        ];

        return $this->getResponse($url, $bodyParameters);
    }

    private function getResponse(string $url, array $bodyParameters)
    {
        $client = new Client();

        try {
            $response = $client->post($url, [
                'cert' => self::BANKID_TEST_CERTIFICATION_20220818,
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

    public function generateQRCode()
    {
        // BankID generate animated QR code string
    }
}
