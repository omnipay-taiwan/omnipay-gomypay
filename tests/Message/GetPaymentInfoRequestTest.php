<?php

namespace Omnipay\Gomypay\Tests\Message;

use Omnipay\Gomypay\Message\GetPaymentInfoRequest;
use Omnipay\Tests\TestCase;

class GetPaymentInfoRequestTest extends TestCase
{
    /**
     * @var GetPaymentInfoRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new GetPaymentInfoRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'CustomerId' => '80013554',
            'Str_Check' => '2b1bef9d8ab6a81e9a2739c6ecc64ef8',
        ]);
    }

    public function testGetBarcodeData()
    {
        $this->getHttpRequest()->query->replace([
            'Send_Type' => '2',
            'result' => '1',
            'OrderID' => '2020050700000000001',
            'e_orderno' => '2020050701',
            'e_payaccount' => '0055600701508830',
            'LimitDate' => '2020/07/01',
            'code1' => '0907016R5',
            'code2' => '0055600701508830',
            'code3' => '090752000000050',
            'ret_msg' => '取號成功',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
        ]);
        $this->request->setAmount('50');

        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('取號成功', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
        $this->assertEquals('2020050701', $response->getTransactionId());
        $this->assertEquals('2020050700000000001', $response->getTransactionReference());
    }

    public function testGetVirtualAccountData()
    {
        $this->getHttpRequest()->query->replace([
            'Send_Type' => '4',
            'result' => '1',
            'OrderID' => '2020050700000000001',
            'e_orderno' => '2020050701',
            'e_payaccount' => '013 - 國泰世華 - 0055600701508856',
            'LimitDate' => '2020/07/01',
            'ret_msg' => '取號成功',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
        ]);
        $this->request->setAmount('50');

        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('取號成功', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
        $this->assertEquals('2020050701', $response->getTransactionId());
        $this->assertEquals('2020050700000000001', $response->getTransactionReference());
    }

    public function testGetCvsData()
    {
        $this->getHttpRequest()->query->replace([
            'Send_Type' => '6',
            'StoreType' => '3',
            'result' => '1',
            'OrderID' => '2020050700000000001',
            'e_orderno' => '2020050701',
            'PinCode' => 'GMPA2018383076',
            'ret_msg' => '取號成功',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
        ]);
        $this->request->setAmount('50');

        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('取號成功', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
        $this->assertEquals('2020050701', $response->getTransactionId());
        $this->assertEquals('2020050700000000001', $response->getTransactionReference());
    }
}
