<?php

namespace Omnipay\Gomypay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Gomypay\Traits\HasGomypay;

class GetPaymentInfoRequest extends AbstractRequest
{
    use HasGomypay;

    public function getData()
    {
        return $this->httpRequest->query->all();
    }

    /**
     * @throws InvalidRequestException
     * @throws InvalidResponseException
     */
    public function sendData($data)
    {
        $data = array_merge(['Amount' => (int) $this->getAmount()], $data);

        if (! hash_equals($this->makeHash($data), $data['str_check'])) {
            throw new InvalidResponseException('Invalid hash');
        }

        return $this->response = new GetPaymentInfoResponse($this, $data);
    }
}
