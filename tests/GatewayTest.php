<?php

namespace Omnipay\Gomypay\Tests;

use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Gomypay\Gateway;
use Omnipay\Gomypay\PaymentMethod;
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
            'CustomerId' => '80013554',
            'Str_Check' => '2b1bef9d8ab6a81e9a2739c6ecc64ef8',
            'testMode' => true,
        ]);
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase([
            'transaction_id' => '2020050701',
            'amount' => '1000',
            'description' => 'good to drink',
            'payment_method' => PaymentMethod::CREDIT_CARD,
            'return_url' => 'https://foo.bar/return_url',
            'notify_url' => 'https://foo.bar/callback_url',

            'buyer_name' => 'foo',
            'buyer_telm' => '0912345678',
            'buyer_mail' => 'foo@bar.com',
        ])->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('https://n.gomypay.asia/TestShuntClass.aspx', $response->getRedirectUrl());
        $this->assertEquals('POST', $response->getRedirectMethod());
        $this->assertEquals('2020050701', $response->getTransactionId());

        $this->assertEquals([
            'Send_Type' => PaymentMethod::CREDIT_CARD,
            'Pay_Mode_No' => 2,
            'CustomerId' => '80013554',
            'Order_No' => '2020050701',
            'Amount' => '1000',
            'TransCode' => '00',
            'Buyer_Name' => 'foo',
            'Buyer_Telm' => '0912345678',
            'Buyer_Mail' => 'foo@bar.com',
            'Buyer_Memo' => 'good to drink',
            'TransMode' => 1,
            'Installment' => 0,
            'Return_url' => 'https://foo.bar/return_url',
            'Callback_Url' => 'https://foo.bar/callback_url',
        ], $response->getData());
    }

    public function testCompletePurchase()
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

        $response = $this->gateway->completePurchase(['amount' => '50'])->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('授權成功', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
        $this->assertEquals('2020050701', $response->getTransactionId());
        $this->assertEquals('2020050700000000001', $response->getTransactionReference());
    }

    public function testAcceptNotification()
    {
        $this->getHttpRequest()->request->replace([
            'Send_Type' => '6',
            'StoreType' => '3',
            'result' => '1',
            'ret_msg' => '已繳費',
            'OrderID' => '2020050700000000001',
            'e_money' => '100',
            'PayAmount' => '50',
            'e_date' => '20200507',
            'e_time' => '12:30:59',
            'e_orderno' => '2020050701',
            'PinCode' => 'GMPA2018383076',
            'Barcode2' => '123456',
            'Market_ID' => 'SE',
            'Shop_Store_Name' => '7-11(地址)',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
        ]);

        $request = $this->gateway->acceptNotification(['amount' => '50']);

        $this->assertEquals(NotificationInterface::STATUS_COMPLETED, $request->getTransactionStatus());
        $this->assertEquals('已繳費', $request->getMessage());
        $this->assertEquals('2020050701', $request->getTransactionId());
        $this->assertEquals('2020050700000000001', $request->getTransactionReference());
    }

    public function testFetchTransaction()
    {
        $this->setMockHttpResponse('FetchTransactionSuccess.txt');
        $response = $this->gateway->fetchTransaction(['transaction_id' => 'AH15482399052114'])->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('已繳費', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
        $this->assertEquals('AH15482399052114', $response->getTransactionId());
        $this->assertEquals('2019012300000000569', $response->getTransactionReference());
    }

    public function testGetPaymentInfo()
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
        $response = $this->gateway->getPaymentInfo(['amount' => '50'])->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('取號成功', $response->getMessage());
        $this->assertEquals('1', $response->getCode());
        $this->assertEquals('2020050701', $response->getTransactionId());
        $this->assertEquals('2020050700000000001', $response->getTransactionReference());
    }
}
