<?php

namespace Omnipay\Gomypay\Tests\Message;

use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Gomypay\Message\AcceptNotificationRequest;
use Omnipay\Tests\TestCase;

class AcceptNotificationRequestTest extends TestCase
{
    /**
     * @var AcceptNotificationRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new AcceptNotificationRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'CustomerId' => '80013554',
            'Str_Check' => '2b1bef9d8ab6a81e9a2739c6ecc64ef8',
        ]);
    }

    public function testGetCreditCardData()
    {
        $this->getHttpRequest()->request->replace([
            'Send_Type' => '0',
            'result' => '1',
            'ret_msg' => '授權成功',
            'OrderID' => '2020050700000000001',
            'e_Cur' => 'NT',
            'e_money' => '50',
            'e_date' => '20200507',
            'e_time' => '12:30:59',
            'e_orderno' => '2020050701',
            'e_no' => '80013554',
            'e_outlay' => '2',
            'avcode' => '012345',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
            'Invoice_No' => '12345',
            'CardLastNum' => '2222',
        ]);

        $this->assertEquals(NotificationInterface::STATUS_COMPLETED, $this->request->getTransactionStatus());
        $this->assertEquals('授權成功', $this->request->getMessage());
        $this->assertEquals('2020050701', $this->request->getTransactionId());
        $this->assertEquals('2020050700000000001', $this->request->getTransactionReference());
    }

    public function testGetUnionPayData()
    {
        $this->getHttpRequest()->request->replace([
            'Send_Type' => '1',
            'result' => '1',
            'ret_msg' => '授權成功',
            'OrderID' => '2020050700000000001',
            'e_Cur' => 'NT',
            'e_money' => '50',
            'e_date' => '20200507',
            'e_time' => '12:30:59',
            'e_orderno' => '2020050701',
            'e_no' => '80013554',
            'e_outlay' => '2',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
        ]);

        $this->assertEquals(NotificationInterface::STATUS_COMPLETED, $this->request->getTransactionStatus());
        $this->assertEquals('授權成功', $this->request->getMessage());
        $this->assertEquals('2020050701', $this->request->getTransactionId());
        $this->assertEquals('2020050700000000001', $this->request->getTransactionReference());
    }

    public function testGetBarcodeData()
    {
        $this->getHttpRequest()->request->replace([
            'Send_Type' => '2',
            'result' => '1',
            'ret_msg' => '授權成功',
            'OrderID' => '2020050700000000001',
            'e_money' => '100',
            'PayAmount' => '50',
            'e_date' => '20200507',
            'e_time' => '12:30:59',
            'e_orderno' => '2020050701',
            'e_payaccount' => '0055600701508856',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
        ]);

        $this->assertEquals(NotificationInterface::STATUS_COMPLETED, $this->request->getTransactionStatus());
        $this->assertEquals('授權成功', $this->request->getMessage());
        $this->assertEquals('2020050701', $this->request->getTransactionId());
        $this->assertEquals('2020050700000000001', $this->request->getTransactionReference());
    }

    public function testGetVirtualAccountData()
    {
        $this->getHttpRequest()->request->replace([
            'Send_Type' => '4',
            'result' => '1',
            'ret_msg' => '授權成功',
            'OrderID' => '2020050700000000001',
            'e_money' => '100',
            'PayAmount' => '50',
            'e_date' => '20200507',
            'e_time' => '12:30:59',
            'e_orderno' => '2020050701',
            'e_payaccount' => '0055600701508856',
            'e_PayInfo' => '013,08856',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
        ]);

        $this->assertEquals(NotificationInterface::STATUS_COMPLETED, $this->request->getTransactionStatus());
        $this->assertEquals('授權成功', $this->request->getMessage());
        $this->assertEquals('2020050701', $this->request->getTransactionId());
        $this->assertEquals('2020050700000000001', $this->request->getTransactionReference());
    }

    public function testGetWebAtmData()
    {
        $this->getHttpRequest()->request->replace([
            'Send_Type' => '3',
            'result' => '1',
            'ret_msg' => '授權成功',
            'OrderID' => '2020050700000000001',
            'e_money' => '100',
            'PayAmount' => '50',
            'e_date' => '20200507',
            'e_time' => '12:30:59',
            'e_orderno' => '2020050701',
            'e_payaccount' => '0055600701508856',
            'e_PayInfo' => '013,08856',
            'str_check' => 'bf577c7a76d440a797c1716aff9c01c9',
        ]);

        $this->assertEquals(NotificationInterface::STATUS_COMPLETED, $this->request->getTransactionStatus());
        $this->assertEquals('授權成功', $this->request->getMessage());
        $this->assertEquals('2020050701', $this->request->getTransactionId());
        $this->assertEquals('2020050700000000001', $this->request->getTransactionReference());
    }

    public function testGetCvsData()
    {
        $this->getHttpRequest()->request->replace([
            'Send_Type' => '6',
            'StoreType' => '3',
            'result' => '1',
            'ret_msg' => '授權成功',
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

        $this->assertEquals(NotificationInterface::STATUS_COMPLETED, $this->request->getTransactionStatus());
        $this->assertEquals('授權成功', $this->request->getMessage());
        $this->assertEquals('2020050701', $this->request->getTransactionId());
        $this->assertEquals('2020050700000000001', $this->request->getTransactionReference());
    }
}
