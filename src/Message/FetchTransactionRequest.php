<?php

namespace Omnipay\Gomypay\Message;

use Omnipay\Gomypay\Traits\HasGomypay;

class FetchTransactionRequest extends AbstractRequest
{
    use HasGomypay;

    public function getData()
    {
        $this->validate('transactionId');

        return [
            'Order_No' => $this->getTransactionId(),
            'CustomerId' => $this->getCustomerId(),
            'Str_Check' => $this->getStrCheck(),
        ];
    }

    public function sendData($data)
    {
        $response = $this->httpClient->request(
            'POST',
            $this->getUrl('CallOrder.aspx'),
            ['content-type' => 'application/x-www-form-urlencoded'],
            http_build_query($data)
        );
        $data = json_decode((string) $response->getBody(), true);

        return $this->response = new FetchTransactionResponse($this, $data);
    }
}
