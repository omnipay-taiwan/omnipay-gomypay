<?php

namespace Omnipay\Gomypay\Tests\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Gomypay\Message\PurchaseRequest;
use Omnipay\Gomypay\PaymentMethod;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'CustomerId' => '80013554',
            'Str_Check' => '2b1bef9d8ab6a81e9a2739c6ecc64ef8',
            'test_mode' => true,

            'transaction_id' => '2020050701',
            'amount' => '1000',
            'description' => 'good to drink',
            'return_url' => 'https://foo.bar/return_url',
            'notify_url' => 'https://foo.bar/callback_url',

            'Buyer_Name' => 'foo',
            'Buyer_Telm' => '0912345678',
            'Buyer_Mail' => 'foo@bar.com',
        ]);
    }

    public function testGetCreditCardData()
    {
        $this->request->setPaymentMethod(PaymentMethod::CREDIT_CARD);

        $response = $this->request->send();
        $data = $response->getRedirectData();

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
        ], $data);
    }

    public function testGetCreditCardDataWithCard()
    {
        $this->request->setPaymentMethod(PaymentMethod::CREDIT_CARD);

        $card = new CreditCard($this->getValidCard());
        $this->request->setCard($card);
        $response = $this->request->send();
        $data = $response->getRedirectData();

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
            'CardNo' => $card->getNumber(),
            'ExpireDate' => $card->getExpiryDate('ym'),
            'CVV' => $card->getCvv(),
            'TransMode' => 1,
            'Installment' => 0,
            'Return_url' => 'https://foo.bar/return_url',
            'Callback_Url' => 'https://foo.bar/callback_url',
        ], $data);
    }

    public function testGetUnionPayData()
    {
        $this->request->setPaymentMethod(PaymentMethod::UNION_PAY);

        $response = $this->request->send();
        $data = $response->getRedirectData();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('https://n.gomypay.asia/TestShuntClass.aspx', $response->getRedirectUrl());
        $this->assertEquals('POST', $response->getRedirectMethod());
        $this->assertEquals('2020050701', $response->getTransactionId());

        $this->assertEquals([
            'Send_Type' => PaymentMethod::UNION_PAY,
            'Pay_Mode_No' => 2,
            'CustomerId' => '80013554',
            'Order_No' => '2020050701',
            'Amount' => '1000',
            'TransCode' => '00',
            'Buyer_Name' => 'foo',
            'Buyer_Telm' => '0912345678',
            'Buyer_Mail' => 'foo@bar.com',
            'Buyer_Memo' => 'good to drink',
            'Return_url' => 'https://foo.bar/return_url',
            'Callback_Url' => 'https://foo.bar/callback_url',
        ], $data);
    }

    public function testGetBarcodeData()
    {
        $this->request->setPaymentMethod(PaymentMethod::BARCODE);

        $response = $this->request->send();
        $data = $response->getRedirectData();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('https://n.gomypay.asia/TestShuntClass.aspx', $response->getRedirectUrl());
        $this->assertEquals('POST', $response->getRedirectMethod());
        $this->assertEquals('2020050701', $response->getTransactionId());

        $this->assertEquals([
            'Send_Type' => PaymentMethod::BARCODE,
            'Pay_Mode_No' => 2,
            'CustomerId' => '80013554',
            'Order_No' => '2020050701',
            'Amount' => '1000',
            'Buyer_Name' => 'foo',
            'Buyer_Telm' => '0912345678',
            'Buyer_Mail' => 'foo@bar.com',
            'Buyer_Memo' => 'good to drink',
            'Return_url' => 'https://foo.bar/return_url',
            'Callback_Url' => 'https://foo.bar/callback_url',
        ], $data);
    }

    public function testGetWebAtmData()
    {
        $this->request->setPaymentMethod(PaymentMethod::WEB_ATM);

        $response = $this->request->send();
        $data = $response->getRedirectData();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('https://n.gomypay.asia/TestShuntClass.aspx', $response->getRedirectUrl());
        $this->assertEquals('POST', $response->getRedirectMethod());
        $this->assertEquals('2020050701', $response->getTransactionId());

        $this->assertEquals([
            'Send_Type' => PaymentMethod::WEB_ATM,
            'Pay_Mode_No' => 2,
            'CustomerId' => '80013554',
            'Order_No' => '2020050701',
            'Amount' => '1000',
            'Buyer_Name' => 'foo',
            'Buyer_Telm' => '0912345678',
            'Buyer_Mail' => 'foo@bar.com',
            'Buyer_Memo' => 'good to drink',
            'Return_url' => 'https://foo.bar/return_url',
            'Callback_Url' => 'https://foo.bar/callback_url',
        ], $data);
    }

    public function testGetVirtualAccountData()
    {
        $this->request->setPaymentMethod(PaymentMethod::VIRTUAL_ACCOUNT);
        $this->request->setPaymentInfoUrl('https://foo.bar/payment_info_url');

        $response = $this->request->send();
        $data = $response->getRedirectData();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('https://n.gomypay.asia/TestShuntClass.aspx', $response->getRedirectUrl());
        $this->assertEquals('POST', $response->getRedirectMethod());
        $this->assertEquals('2020050701', $response->getTransactionId());

        $this->assertEquals([
            'Send_Type' => PaymentMethod::VIRTUAL_ACCOUNT,
            'Pay_Mode_No' => 2,
            'CustomerId' => '80013554',
            'Order_No' => '2020050701',
            'Amount' => '1000',
            'Buyer_Name' => 'foo',
            'Buyer_Telm' => '0912345678',
            'Buyer_Mail' => 'foo@bar.com',
            'Buyer_Memo' => 'good to drink',
            'Return_url' => 'https://foo.bar/payment_info_url',
            'Callback_Url' => 'https://foo.bar/callback_url',
        ], $data);
    }

    public function testGetCvsData()
    {
        $this->request->setPaymentMethod(PaymentMethod::CVS);
        $this->request->setPaymentInfoUrl('https://foo.bar/payment_info_url');
        $this->request->setStoreType(3);

        $response = $this->request->send();
        $data = $response->getRedirectData();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('https://n.gomypay.asia/TestShuntClass.aspx', $response->getRedirectUrl());
        $this->assertEquals('POST', $response->getRedirectMethod());
        $this->assertEquals('2020050701', $response->getTransactionId());

        $this->assertEquals([
            'Send_Type' => PaymentMethod::CVS,
            'Pay_Mode_No' => 2,
            'CustomerId' => '80013554',
            'Order_No' => '2020050701',
            'Amount' => '1000',
            'StoreType' => '3',
            'Buyer_Name' => 'foo',
            'Buyer_Telm' => '0912345678',
            'Buyer_Mail' => 'foo@bar.com',
            'Buyer_Memo' => 'good to drink',
            'Return_url' => 'https://foo.bar/payment_info_url',
            'Callback_Url' => 'https://foo.bar/callback_url',
        ], $data);
    }
}
