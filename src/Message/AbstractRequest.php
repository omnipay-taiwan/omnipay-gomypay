<?php

namespace Omnipay\Gomypay\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $host = 'https://n.gomypay.asia/';

    public function getUrl($uri)
    {
        return $this->getTestMode()
            ? $this->host.'Test'.$uri
            : $this->host.$uri;
    }
}
