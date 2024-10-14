<?php

namespace Omnipay\Gomypay\Message;

use Omnipay\Gomypay\Traits\HasGomypay;
use Omnipay\Gomypay\Traits\HasOrderNo;

class VoidRequest extends AbstractRequest
{
    use HasGomypay;
    use HasOrderNo;

    public function getGoodsReturn()
    {
        return $this->getParameter('Goods_Return');
    }

    /**
     * 退貨註記請填 1(申請退貨)
     */
    public function setGoodsRetrun($value)
    {
        return $this->setParameter('Goods_Return', $value);
    }

    public function getGoodsReturnReason()
    {
        return $this->getParameter('Goods_Return_Reason');
    }

    /**
     * 退貨原因
     */
    public function setGoodsReturnReason($value)
    {
        return $this->setParameter('Goods_Return_Reason', $value);
    }

    public function getData()
    {
        return [
            'Order_No' => $this->getTransactionId(),
            'CustomerId' => $this->getCustomerId(),
            'Str_Check' => $this->getStrCheck(),
            'Goods_Return' => $this->getGoodsReturn() ?: 1,
            'Goods_Return_Reason' => $this->getGoodsReturnReason() ?: '退貨',
        ];
    }

    public function sendData($data)
    {
        $response = $this->httpClient->request(
            'POST',
            $this->getUrl('GoodReturn.aspx'),
            ['content-type' => 'application/x-www-form-urlencoded'],
            http_build_query($data)
        );
        $data = json_decode((string) $response->getBody(), true);

        return $this->response = new VoidResponse($this, $data);
    }
}
