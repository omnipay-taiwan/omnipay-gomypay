<?php

namespace Omnipay\Gomypay\Traits;

trait HasOrderNo
{
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
}
