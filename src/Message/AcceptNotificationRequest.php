<?php

namespace Omnipay\Gomypay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Gomypay\Traits\HasGomypay;

class AcceptNotificationRequest extends AbstractRequest implements NotificationInterface
{
    use HasGomypay;

    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    /**
     * @throws InvalidRequestException
     */
    public function sendData($data)
    {
        $data = array_merge(['Amount' => (int) $this->getAmount()], $data);
        if (! hash_equals($this->makeHash($data), $data['str_check'] ?: '')) {
            throw new InvalidRequestException('Incorrect hash');
        }

        return $this->response = new AcceptNotificationResponse($this, $data);
    }

    public function getTransactionId()
    {
        return $this->getNotificationResponse()->getTransactionId();
    }

    public function getTransactionReference()
    {
        return $this->getNotificationResponse()->getTransactionReference();
    }

    public function getTransactionStatus()
    {
        return $this->getNotificationResponse()->getTransactionStatus();
    }

    public function getMessage()
    {
        return $this->getNotificationResponse()->getMessage();
    }

    private function getNotificationResponse()
    {
        return ! $this->response ? $this->send() : $this->response;
    }
}
