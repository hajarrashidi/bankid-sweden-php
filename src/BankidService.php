<?php

namespace BankID;

use BankID\Models\Response\ErrorResponse;
use BankID\Models\Response\ResponseModel;
use BankID\Models\Response\CollectResponse;
use BankID\Models\Response\OrderResponse;
use BankID\Models\Response\CancelResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BankidService
{
    private Bankid $bankidClient;
    private Client $guzzleClient;

    public function __construct(Bankid $bankid)
    {
        $this->bankidClient = $bankid;

        $this->guzzleClient = new Client([
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function auth(string $endUserIp, ?string $personalNumber = null)
    {
        $parameters = [
            'endUserIp' => $endUserIp,
        ];

        if ($personalNumber !== null) {
            $parameters['personalNumber'] = $personalNumber;
        }

        return $this->makeRequest(Bankid::METHOD_AUTH, $parameters, OrderResponse::class);
    }

    public function collect(string $orderRef): CollectResponse
    {
        $parameters = [
            'orderRef' => $orderRef,
        ];

        return $this->makeRequest(Bankid::METHOD_COLLECT, $parameters, CollectResponse::class);
    }

    public function cancel(string $orderRef)
    {
        $parameters = [
            'orderRef' => $orderRef,
        ];

        return $this->makeRequest(Bankid::METHOD_CANCEL, $parameters, CancelResponse::class);
    }

    private function makeRequest(string $method, array $parameters, string $responseClass = null)
    {
        $url = $this->bankidClient->getBankidUrl($method);

        try {
            $response = $this->guzzleClient->post($url, [
                'cert' => $this->bankidClient->getCertificationPath(),
                'body' => json_encode($parameters),
            ]);
        } catch (ClientException $e) {
            return new ErrorResponse($e->getResponse());
        }

        return $responseClass !== null ? new $responseClass($response) : $response;
    }

}