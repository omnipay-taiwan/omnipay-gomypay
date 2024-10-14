<?php

namespace Omnipay\Gomypay\Tests\Message;

use Omnipay\Gomypay\Message\FetchTransactionRequest;
use Omnipay\Tests\TestCase;

class FetchTransactionRequestTest extends TestCase
{
    /**
     * @var FetchTransactionRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new FetchTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'CustomerId' => '42816104A05',
            'Str_Check' => '2b1bef9d8ab6a81e9a2739c6ecc64ef8',
            'test_mode' => true,

            'transaction_id' => 'AH15482399052114',
        ]);
    }

    public function testGetData()
    {
        $this->setMockHttpResponse('FetchTransactionSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('已繳費', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
        $this->assertEquals('AH15482399052114', $response->getTransactionId());
        $this->assertEquals('2019012300000000569', $response->getTransactionReference());
    }
}
