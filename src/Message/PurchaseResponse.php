<?php

namespace Omnipay\Gomypay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->request->getTestMode()
            ? 'https://n.gomypay.asia/TestShuntClass.aspx'
            : 'https://n.gomypay.asia/ShuntClass.aspx';
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }

    public function getTransactionId()
    {
        return $this->data['Order_No'];
    }
}
