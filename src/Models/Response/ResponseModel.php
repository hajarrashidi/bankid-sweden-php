<?php

namespace BankID\Models\Response;

use Psr\Http\Message\ResponseInterface;

class ResponseModel
{
    public function __construct(ResponseInterface $response = null)
    {
        $this->hydrate($response);
    }

    /**
     * Populate the object with data from a ResponseInterface.
     *
     * @param ResponseInterface|null $response
     * @return void
     */
    public function hydrate(?ResponseInterface $response): void
    {
        if ($response) {
            $responseBody = $response->getBody()->getContents();
            $responseArray = json_decode($responseBody, true);

            foreach ($responseArray as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
}