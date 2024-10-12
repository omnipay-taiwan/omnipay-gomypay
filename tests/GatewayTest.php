<?php

namespace Omnipay\Gomypay\Tests;

use Omnipay\Gomypay\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    protected $options;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->initialize([
            'CustomerId' => '2020050701',
            'Str_Check' => '2b1bef9d8ab6a81e9a2739c6ecc64ef8',
            'testMode' => true,
        ]);

        $this->options = [
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ];
    }

    public function testAuthorize()
    {
        $this->markTestSkipped();

        $this->setMockHttpResponse('AuthorizeSuccess.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('1234', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }
}
