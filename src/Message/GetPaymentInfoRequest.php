<?php

namespace Omnipay\Gomypay\Message;

class GetPaymentInfoRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
        return $this->response = new GetPaymentInfoResponse($this, $data);
    }
}
