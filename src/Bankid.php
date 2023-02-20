<?php

namespace BankID;

class Bankid
{
    private $apiVersion;

    private $baseUrl;

    const ENVIRONMENT_TEST = 'test';
    const ENVIRONMENT_PRODUCTION = 'production';

    const BASE_URL_TEST = 'https://appapi2.test.bankid.com/rp/v';
    const BASE_URL_PRODUCTION = 'https://appapi2.bankid.com/rp/v';

    const METHOD_AUTH = 'auth';
    const METHOD_SIGN = 'sign';
    const METHOD_COLLECT = 'collect';

    const RESPONSE_BODY_KEY_ORDERREF = 'orderRef';
    const RESPONSE_BODY_KEY_AUTOSTARTTOKEN = 'autoStartToken';

    const API_VERSION_5_1 = 5.1;
    
    const BANKID_TEST_CERTIFICATION_20220818 = __DIR__ . '/certifications/FPTestcert4_20220818.pem';

    /**
     * @param string $apiVersion currently only '5.1' is supported
     * @param string $environment either 'test' or 'production'
     */
    public function __construct(string $environment, string $apiVersion)
    {
        $this->apiVersion = $apiVersion;
        $this->baseUrl = ($environment === self::ENVIRONMENT_PRODUCTION) ? self::BASE_URL_PRODUCTION : self::BASE_URL_TEST;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function getAuthUrl(): string
    {
        return $this->getMethodUrl(self::METHOD_AUTH);
    }

    public function getSignUrl(): string
    {
        return $this->getMethodUrl(self::METHOD_SIGN);
    }

    public function getCollectUrl(): string
    {
        return $this->getMethodUrl(self::METHOD_COLLECT);
    }

    public function getMethodUrl(string $method): string
    {
        return "{$this->baseUrl}{$this->apiVersion}/{$method}";
    }
}