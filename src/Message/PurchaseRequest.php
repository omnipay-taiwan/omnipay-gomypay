<?php

namespace Omnipay\Gomypay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Gomypay\PaymentMethod;
use Omnipay\Gomypay\Traits\HasGomypay;

/**
 * Authorize Request
 *
 * @method PurchaseResponse send()
 */
class PurchaseRequest extends AbstractRequest
{
    use HasGomypay;

    public function getSendType()
    {
        return $this->getPaymentMethod();
    }

    /**
     * 傳送型態請填 0 (0.信用卡 1.銀聯卡 2.超商條碼 3.WebAtm 4.虛擬帳號 6.超商代碼 7.LinePay)
     */
    public function setSendType($value)
    {
        return $this->setPaymentMethod($value);
    }

    public function getPayModeNo()
    {
        return $this->getParameter('Pay_Mode_No');
    }

    /**
     * 付款模式請填 2
     */
    public function setPayModeNo($value)
    {
        return $this->setParameter('Pay_Mode_No', $value);
    }

    public function getOrderNo()
    {
        return $this->getTransactionId();
    }

    /**
     * 交易單號，如無則自動帶入系統預設交易單號
     * 若使用系統預設交易畫面，交易單號不可為無
     */
    public function setOrderNo($value)
    {
        return $this->setTransactionId($value);
    }

    public function getAmount()
    {
        return parent::getAmount();
    }

    /**
     * 交易金額(最低金額 35 元)
     */
    public function setAmount($value)
    {
        return parent::setAmount($value);
    }

    public function getTransCode()
    {
        return $this->getParameter('TransCode');
    }

    /**
     * 交易類別請填 00(授權)
     */
    public function setTransCode($value)
    {
        return $this->setParameter('TransCode', $value);
    }

    public function getBuyerName()
    {
        return $this->getParameter('Buyer_Name');
    }

    /**
     * 消費者姓名，不可含特殊符號及數字，未帶將自動轉入系統預設付款頁面
     */
    public function setBuyerName($value)
    {
        return $this->setParameter('Buyer_Name', $value);
    }

    public function getBuyerTelm()
    {
        return $this->getParameter('Buyer_Telm');
    }

    /**
     * 消費者手機(數字，不可全形)，未帶將自動轉入系統預設付款頁面
     */
    public function setBuyerTelm($value)
    {
        return $this->setParameter('Buyer_Telm', $value);
    }

    public function getBuyerMail()
    {
        return $this->getParameter('Buyer_Mail');
    }

    /**
     * 消費者 Email(不可全形) ，未帶將自動轉入系統預設付款頁面
     */
    public function setBuyerMail($value)
    {
        return $this->setParameter('Buyer_Mail', $value);
    }

    public function getBuyerMemo()
    {
        return $this->getDescription();
    }

    /**
     * 消費備註(交易內容)，未帶將自動轉入系統預設付款頁面
     */
    public function setBuyerMemo($value)
    {
        return $this->setDescription($value);
    }

    public function getCardNo()
    {
        return $this->getParameter('CardNo');
    }

    /**
     * 信用卡號，如無將自動轉入系統預設付款頁面
     */
    public function setCardNo($value)
    {
        return $this->setParameter('CardNo', $value);
    }

    public function getExpireDate()
    {
        return $this->getParameter('ExpireDate');
    }

    /**
     * 卡片有效日期(YYMM)，如無將自動轉入系統預設付款頁面
     */
    public function setExpireDate($value)
    {
        return $this->setParameter('ExpireDate', $value);
    }

    public function getCVV()
    {
        return $this->getParameter('CVV');
    }

    /**
     * 卡片認證碼，如無將自動轉入系統預設付款頁面
     */
    public function setCVV($value)
    {
        return $this->setParameter('CVV', $value);
    }

    public function getTransMode()
    {
        return $this->getParameter('TransMode');
    }

    /**
     * 交易模式一般請填(1)、分期請填(2)
     */
    public function setTransMode($value)
    {
        return $this->setParameter('TransMode', $value);
    }

    /**
     * 期數，無期數請填 0
     */
    public function getInstallment()
    {
        return $this->getParameter('Installment');
    }

    public function setInstallment($value)
    {
        return $this->setParameter('Installment', $value);
    }

    public function getReturnUrl()
    {
        return parent::getReturnUrl();
    }

    /**
     * 授權結果回傳網址：如無則自動轉入系統預設授權頁面
     * 註 1:如果要用 JSON 回傳請勿帶此參註
     * 2:如果是實名制 OTP 店家，若要接回傳值，請填入接收網址
     */
    public function setReturnUrl($value)
    {
        return parent::setReturnUrl($value);
    }

    public function getCallbackUrl()
    {
        return $this->getNotifyUrl();
    }

    /**
     * 背景對帳網址，如未填寫默認不進行背景對帳
     */
    public function setCallbackUrl($value)
    {
        return $this->setNotifyUrl($value);
    }

    public function getPaymentInfoUrl()
    {
        return $this->getParameter('Payment_Info_Url');
    }

    /**
     * 背景對帳網址，如未填寫默認不進行背景對帳
     */
    public function setPaymentInfoUrl($value)
    {
        return $this->setParameter('Payment_Info_Url', $value);
    }

    public function getEReturn()
    {
        return $this->getParameter('e_return');
    }

    /**
     * 使用 json 回傳是否交易成功(限用非 3D 驗證)，請填 1
     * 註1:如果要用預設交易頁面請勿帶此參數
     * 註2:如果是實名制 OTP 店家，無法使用 json 接收回傳值，故無需填入
     */
    public function setEReturn($value)
    {
        return $this->setParameter('e_return', $value);
    }

    public function getStoreType()
    {
        return $this->getParameter('StoreType');
    }

    /**
     * 0:全家 1:ok 2:萊爾富 3:7-11
     */
    public function setStoreType($value)
    {
        return $this->setParameter('StoreType', $value);
    }

    public function getData()
    {
        $this->validate(
            'transactionId',
            'amount',
            'description',
            'paymentMethod',
            'CustomerId',
            'Buyer_Name',
            'Buyer_Telm',
            'Buyer_Mail',
        );
        $paymentMethod = (int) $this->getPaymentMethod();

        $lookup = [
            PaymentMethod::CREDIT_CARD => 'getCreditCardData',
            PaymentMethod::UNION_PAY => 'getUnionPayData',
            PaymentMethod::BARCODE => 'getBarcodeData',
            PaymentMethod::WEB_ATM => 'getWebAtmData',
            PaymentMethod::VIRTUAL_ACCOUNT => 'getVirtualAccountData',
            PaymentMethod::CVS => 'getCvsData',
        ];
        $data = $this->{$lookup[$paymentMethod]}();

        return array_filter($data, static function ($value) {
            return $value !== null && $value !== '';
        });
    }

    /**
     * @throws InvalidRequestException
     */
    private function getCreditCardData(): array
    {
        $card = $this->getCard();

        $cardNo = $card ? $card->getNumber() : $this->getCardNo();
        $expireDate = $card ? $card->getExpiryDate('ym') : $this->getExpireDate();
        $cvv = $card ? $card->getCvv() : $this->getCVV();

        $transMode = $this->getTransMode() ?: 1;
        $installment = (int) $this->getInstallment() ?: 0;
        if ($installment > 0) {
            $transMode = 2;
        }

        $eReturn = $this->getEReturn();
        $strCheck = $eReturn ? $this->getStrCheck() : null;

        return [
            'Send_Type' => PaymentMethod::CREDIT_CARD,
            'Pay_Mode_No' => $this->getPayModeNo() ?: '2',
            'CustomerId' => $this->getCustomerId(),
            'Order_No' => $this->getOrderNo(),
            'Amount' => (int) $this->getAmount(),
            'TransCode' => $this->getTransCode() ?: '00',
            'Buyer_Name' => $this->getBuyerName(),
            'Buyer_Telm' => $this->getBuyerTelm(),
            'Buyer_Mail' => $this->getBuyerMail(),
            'Buyer_Memo' => $this->getDescription(),
            'CardNo' => $cardNo,
            'ExpireDate' => $expireDate,
            'CVV' => $cvv,
            'TransMode' => $transMode,
            'Installment' => $installment,
            'Return_url' => $this->getReturnUrl(),
            'Callback_Url' => $this->getCallbackUrl(),
            'e_return' => $eReturn,
            'Str_Check' => $strCheck,
        ];
    }

    private function getUnionPayData()
    {
        return [
            'Send_Type' => PaymentMethod::UNION_PAY,
            'Pay_Mode_No' => $this->getPayModeNo() ?: '2',
            'CustomerId' => $this->getCustomerId(),
            'Order_No' => $this->getOrderNo(),
            'Amount' => (int) $this->getAmount(),
            'TransCode' => $this->getTransCode() ?: '00',
            'Buyer_Name' => $this->getBuyerName(),
            'Buyer_Telm' => $this->getBuyerTelm(),
            'Buyer_Mail' => $this->getBuyerMail(),
            'Buyer_Memo' => $this->getDescription(),
            'Return_url' => $this->getReturnUrl(),
            'Callback_Url' => $this->getCallbackUrl(),
        ];
    }

    private function getBarcodeData()
    {
        $eReturn = $this->getEReturn();
        $strCheck = $eReturn ? $this->getStrCheck() : null;

        return [
            'Send_Type' => PaymentMethod::BARCODE,
            'Pay_Mode_No' => $this->getPayModeNo() ?: '2',
            'CustomerId' => $this->getCustomerId(),
            'Order_No' => $this->getOrderNo(),
            'Amount' => (int) $this->getAmount(),
            'Buyer_Name' => $this->getBuyerName(),
            'Buyer_Telm' => $this->getBuyerTelm(),
            'Buyer_Mail' => $this->getBuyerMail(),
            'Buyer_Memo' => $this->getDescription(),
            'Return_url' => $this->getReturnUrl(),
            'Callback_Url' => $this->getCallbackUrl(),
            'e_return' => $eReturn,
            'Str_Check' => $strCheck,
        ];
    }

    private function getWebAtmData()
    {
        return [
            'Send_Type' => PaymentMethod::WEB_ATM,
            'Pay_Mode_No' => $this->getPayModeNo() ?: '2',
            'CustomerId' => $this->getCustomerId(),
            'Order_No' => $this->getOrderNo(),
            'Amount' => (int) $this->getAmount(),
            'Buyer_Name' => $this->getBuyerName(),
            'Buyer_Telm' => $this->getBuyerTelm(),
            'Buyer_Mail' => $this->getBuyerMail(),
            'Buyer_Memo' => $this->getDescription(),
            'Return_url' => $this->getReturnUrl(),
            'Callback_Url' => $this->getCallbackUrl(),
        ];
    }

    private function getVirtualAccountData()
    {
        $eReturn = $this->getEReturn();
        $strCheck = $eReturn ? $this->getStrCheck() : null;
        $returnUrl = $this->getPaymentInfoUrl() ?: $this->getReturnUrl();

        return [
            'Send_Type' => PaymentMethod::VIRTUAL_ACCOUNT,
            'Pay_Mode_No' => $this->getPayModeNo() ?: '2',
            'CustomerId' => $this->getCustomerId(),
            'Order_No' => $this->getOrderNo(),
            'Amount' => (int) $this->getAmount(),
            'Buyer_Name' => $this->getBuyerName(),
            'Buyer_Telm' => $this->getBuyerTelm(),
            'Buyer_Mail' => $this->getBuyerMail(),
            'Buyer_Memo' => $this->getDescription(),
            'Return_url' => $returnUrl,
            'Callback_Url' => $this->getCallbackUrl(),
            'e_return' => $eReturn,
            'Str_Check' => $strCheck,
        ];
    }

    public function getCvsData()
    {
        $eReturn = $this->getEReturn();
        $strCheck = $eReturn ? $this->getStrCheck() : null;

        return [
            'Send_Type' => PaymentMethod::CVS,
            'Pay_Mode_No' => $this->getPayModeNo() ?: '2',
            'CustomerId' => $this->getCustomerId(),
            'Order_No' => $this->getOrderNo(),
            'Amount' => (int) $this->getAmount(),
            'StoreType' => $this->getStoreType(),
            'Buyer_Name' => $this->getBuyerName(),
            'Buyer_Telm' => $this->getBuyerTelm(),
            'Buyer_Mail' => $this->getBuyerMail(),
            'Buyer_Memo' => $this->getDescription(),
            'Return_url' => $this->getReturnUrl(),
            'Callback_Url' => $this->getCallbackUrl(),
            'e_return' => $eReturn,
            'Str_Check' => $strCheck,
        ];
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
