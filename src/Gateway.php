<?php

namespace Omnipay\Gomypay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Gomypay\Message\AuthorizeRequest;

/**
 * Gomypay Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Gomypay';
    }

    public function getDefaultParameters()
    {
        return [
            'key' => '',
            'testMode' => false,
        ];
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function authorize(array $options = [])
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }
}
