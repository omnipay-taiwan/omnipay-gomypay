<?php

namespace Omnipay\Gomypay\Tests\Message;

use Omnipay\Gomypay\Message\VoidRequest;
use Omnipay\Tests\TestCase;

class VoidRequestTest extends TestCase
{
    /**
     * @var VoidRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new VoidRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'CustomerId' => '42816104A05',
            'Str_Check' => '2b1bef9d8ab6a81e9a2739c6ecc64ef8',
            'test_mode' => true,

            'transaction_id' => 'AH15482399052114',
        ]);
    }

    public function testGetData()
    {
        $this->setMockHttpResponse('VoidSuccess.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('申請退貨完成', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
    }
}
