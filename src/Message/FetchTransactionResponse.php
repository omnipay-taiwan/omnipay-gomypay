<?php

namespace Omnipay\Gomypay\Message;

class FetchTransactionResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return (int) $this->getCode() === 1;
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
