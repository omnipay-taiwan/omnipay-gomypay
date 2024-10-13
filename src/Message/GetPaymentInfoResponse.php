<?php

namespace Omnipay\Gomypay\Message;

class GetPaymentInfoResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return false;
    }

    public function getCode()
    {
        return $this->data['result'];
    }

    public function getMessage()
    {
        return $this->data['ret_msg'];
    }

    public function getTransactionId()
    {
        return $this->data['e_orderno'];
    }

    public function getTransactionReference()
    {
        return $this->data['OrderID'];
    }
}
