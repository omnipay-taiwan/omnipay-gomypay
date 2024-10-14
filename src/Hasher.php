<?php

namespace Omnipay\Gomypay;

class Hasher
{
    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $strCheck;

    public function __construct($customerId, $strCheck)
    {
        $this->customerId = $customerId;
        $this->strCheck = $strCheck;
    }

    public function make(array $data)
    {
        $amount = 0;
        if (array_key_exists('PayAmount', $data)) {
            $amount = $data['PayAmount'];
        } elseif (array_key_exists('e_money', $data)) {
            $amount = $data['e_money'];
        } elseif (array_key_exists('Amount', $data)) {
            $amount = $data['Amount'];
        }

        return md5(implode('', [
            $data['result'],
            $data['e_orderno'],
            $this->customerId,
            $amount,
            $data['OrderID'],
            $this->strCheck,
        ]));
    }
}
