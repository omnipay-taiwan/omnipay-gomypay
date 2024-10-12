<?php

namespace Omnipay\Gomypay;

abstract class PaymentMethod
{
    public const CREDIT_CARD = 0;

    public const UNION_PAY = 1;

    public const BARCODE = 2;

    public const WEB_ATM = 3;

    public const VIRTUAL_ACCOUNT = 4;

    public const CVS = 6;

    public const LINE_PAY = 7;
}
