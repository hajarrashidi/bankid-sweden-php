<?php

use PHPUnit\Framework\TestCase;
use BankID\BankidService;

// Everything will fail, this is just a demo
class BankidServiceTest extends TestCase
{
    private $bankid;

    public function setUp(): void
    {
        $this->bankid = new BankidService();
    }

    public function testAuth()
    {
        $response = $this->bankid->auth('192.0.2.1');
        $this->assertIsArray($response);
        $this->assertArrayHasKey('orderRef', $response);
    }

    public function testCollect()
    {
        $response = $this->bankid->collect('12345');
        $this->assertIsArray($response);
        $this->assertArrayHasKey('status', $response);
    }
}