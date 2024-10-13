<?php

namespace Omnipay\Gomypay\Tests\Message;

use Omnipay\Gomypay\Message\CompletePurchaseRequest;
use Omnipay\Tests\TestCase;

class CompletePurchaseRequestTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'CustomerId' => '80013554',
            'Str_Check' => '2b1bef9d8ab6a81e9a2739c6ecc64ef8',
        ]);
    }

    public function testGetCreditCardData()
    {
        $this->getHttpRequest()->query->replace([
            'Send_Type' => '0',
            'result' => '1',
            'ret_msg' => '授權成功',
            'OrderID' => '2020050700000000001',
            'e_orderno' => '2020050701',
            'AvCode' => '012345',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
            'Invoice_No' => '12345',
            'CardLastNum' => '2222',
        ]);
        $this->request->setAmount('50');

        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('授權成功', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
        $this->assertEquals('2020050701', $response->getTransactionId());
        $this->assertEquals('2020050700000000001', $response->getTransactionReference());
    }

    public function testGetUnionPayData()
    {
        $this->getHttpRequest()->query->replace([
            'Send_Type' => '1',
            'result' => '1',
            'ret_msg' => '授權成功',
            'OrderID' => '2020050700000000001',
            'e_orderno' => '2020050701',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
        ]);
        $this->request->setAmount('50');

        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('授權成功', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
        $this->assertEquals('2020050701', $response->getTransactionId());
        $this->assertEquals('2020050700000000001', $response->getTransactionReference());
    }
}
