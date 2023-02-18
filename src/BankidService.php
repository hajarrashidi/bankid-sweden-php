<?php
namespace BankID;

class BankidService
{
    // BankID /auth endpoint
    public function auth($endUserIp)
    {

        // make a class called BankidApiVersion5_1

        $apiUrl = 'https://appapi2.test.bankid.com/rp/v5.1/auth';
        $requestBody = [
            'personalNumber' => '200001132380',
            'endUserIp' => $endUserIp
        ];
        // get testcert.pem in certifications folder and make a post request to the api
        $client = new \GuzzleHttp\Client([
            'base_uri' => $apiUrl,
            'certifications' => __DIR__ . '/certifications/FPTestcert4_20220818.pem',
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        try {
            $response = $client->request('POST', $apiUrl, ['json' => $requestBody]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            dd($responseBodyAsString);
        }

        $result = json_decode($response->getBody()->getContents());
        dd($result);

        return $result;


    }

    // BankID /sign endpoint
    public function sign()
    {
    }

    // BankID /collect endpoint
    public function collect()
    {
    }

    // BankID generate animated QR code string
    public function generateQRCode()
    {
    }

}