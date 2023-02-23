<?php

namespace BankID;

class Bankid
{
    private string $environment;
    private float $apiVersion;
    private string $baseUrl;

    const ENVIRONMENT_TEST = 'test';
    const ENVIRONMENT_PRODUCTION = 'production';

    const API_VERSION_5_1 = 5.1;

    const BASE_URL_TEST = 'https://appapi2.test.bankid.com/rp/v';
    const BASE_URL_PRODUCTION = 'https://appapi2.bankid.com/rp/v';

    const METHOD_AUTH = 'auth';
    const METHOD_SIGN = 'sign';
    const METHOD_COLLECT = 'collect';
    const METHOD_CANCEL = 'cancel';

    const BANKID_TEST_CERTIFICATION_PATH_20220818 = __DIR__ . '/certifications/FPTestcert4_20220818.pem';

    /**
     * @param string $apiVersion currently only '5.1' is supported
     * @param string $environment either 'test' or 'production'
     */
    public function __construct(string $environment, string $apiVersion)
    {
        $this->environment = $environment;
        $this->apiVersion = $apiVersion;
        $this->baseUrl = ($environment === self::ENVIRONMENT_PRODUCTION) ? self::BASE_URL_PRODUCTION : self::BASE_URL_TEST;
    }

    public function getBankidUrl(string $bankidMethod): string
    {
        return "{$this->baseUrl}{$this->apiVersion}/{$bankidMethod}";
    }

    /**
     * @param string $bankidEnvironment either 'test' or 'production'
     */
    public function getCertificationPath(): string
    {
        // TODO implement support for production environment
        if ($this->environment === self::ENVIRONMENT_PRODUCTION) {
            throw new \Exception('Production environment not supported yet');
        }

        return self::BANKID_TEST_CERTIFICATION_PATH_20220818;
    }
}