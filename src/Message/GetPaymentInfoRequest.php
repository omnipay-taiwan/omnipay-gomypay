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
        $data = array_merge($data, [
            'CustomerId' => $this->getCustomerId(),
            'Amount' => (int) $this->getAmount(),
            'Str_Check' => $this->getStrCheck(),
        ]);

        $keys = ['result', 'e_orderno', 'CustomerId', 'Amount', 'OrderID', 'Str_Check'];
        $plainText = '';
        foreach ($keys as $key) {
            $plainText .= $data[$key];
        }
        $hash = md5($plainText);
        if (! hash_equals($hash, $data['str_check'])) {
            throw new InvalidResponseException('Invalid check');
        }

        return $this->response = new GetPaymentInfoResponse($this, $data);
    }
}
