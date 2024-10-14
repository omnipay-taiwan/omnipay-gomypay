<?php

namespace Omnipay\Gomypay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Gomypay\Traits\HasGomypay;

class CompletePurchaseRequest extends AbstractRequest
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

        if (! array_key_exists('e_orderno', $data)) {
            throw new InvalidResponseException($data['ret_msg']);
        }

        if (! hash_equals($this->makeHash($data), $data['str_check'])) {
            throw new InvalidResponseException('Invalid hash');
        }

        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
