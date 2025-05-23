<?php

namespace Omnipay\Gomypay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Gomypay\Message\AcceptNotificationRequest;
use Omnipay\Gomypay\Message\CompletePurchaseRequest;
use Omnipay\Gomypay\Message\FetchTransactionRequest;
use Omnipay\Gomypay\Message\GetPaymentInfoRequest;
use Omnipay\Gomypay\Message\PurchaseRequest;
use Omnipay\Gomypay\Message\VoidRequest;
use Omnipay\Gomypay\Traits\HasGomypay;

/**
 * Gomypay Gateway
 */
class Gateway extends AbstractGateway
{
    use HasGomypay;

    public function getName()
    {
        return 'Gomypay';
    }

    public function getDefaultParameters()
    {
        return [
            'CustomerId' => null,
            'Str_Check' => null,
            'testMode' => false,
        ];
    }

    public function purchase(array $options = [])
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function completePurchase(array $options = [])
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }

    public function acceptNotification(array $options = [])
    {
        return $this->createRequest(AcceptNotificationRequest::class, $options);
    }

    public function fetchTransaction(array $options = [])
    {
        return $this->createRequest(FetchTransactionRequest::class, $options);
    }

    public function void(array $options = [])
    {
        return $this->createRequest(VoidRequest::class, $options);
    }

    public function getPaymentInfo(array $options = [])
    {
        return $this->createRequest(GetPaymentInfoRequest::class, $options);
    }
}
