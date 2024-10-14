<?php

namespace Omnipay\Gomypay\Message;

class VoidResponse extends AbstractResponse
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
}
