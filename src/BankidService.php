<?php

namespace BankID;

use BankID\Models\Response\ResponseModel;
use BankID\Models\Response\CollectResponse;
use BankID\Models\Response\OrderResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BankidService
{
    private Bankid $bankid;
    private Client $client;

    public function __construct(Bankid $bankid)
    {
        $this->bankid = $bankid;

        $this->client = new Client([
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function auth(string $endUserIp, ?string $personalNumber = null): ?OrderResponse
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

    public function cancel(string $orderRef): ?ResponseModel
    {
        $parameters = [
            'orderRef' => $orderRef,
        ];

        return $this->makeRequest(Bankid::METHOD_CANCEL, $parameters);
    }

    private function makeRequest(string $method, array $parameters, string $responseClass = null): ?ResponseModel
    {
        $url = $this->bankid->getBankidUrl($method);

        try {
            $response = $this->client->post($url, [
                'cert' => $this->bankid->getCertificationPath(),
                'body' => json_encode($parameters),
            ]);

            if ($responseClass !== null) {
                // returns the fully qualified class name (FQCN) of a class, including the namespace.
                return new $responseClass($response);
            }

            return $response;
        } catch (ClientException $e) {
            // TODO: Handle error

        }
    }
}
