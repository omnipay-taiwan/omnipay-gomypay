<?php

namespace Omnipay\Gomypay\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $liveEndpoint = 'https://n.gomypay.asia/ShuntClass.aspx';

    protected $testEndpoint = 'https://n.gomypay.asia/TestShuntClass.aspx';

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
