<?php

namespace Omnipay\Gomypay\Tests\Message;

use Omnipay\Gomypay\Message\PurchaseResponse;
use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testConstruct()
    {
        // response should decode URL format data
        $response = new PurchaseResponse($this->getMockRequest(), ['example' => 'value', 'foo' => 'bar']);
        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testProPurchaseSuccess()
    {
        $this->markTestSkipped();

        $httpResponse = $this->getMockHttpResponse('AuthorizeSuccess.txt');
        $data = json_decode($httpResponse->getBody(), true);
        $response = new PurchaseResponse($this->getMockRequest(), $data);

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('1234', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }
}
