<?php

namespace Omnipay\Gomypay\Tests\Message;

use Omnipay\Gomypay\Message\GetPaymentInfoRequest;
use Omnipay\Tests\TestCase;

class GetPaymentInfoRequestTest extends TestCase
{
    /**
     * @var GetPaymentInfoRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new GetPaymentInfoRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'CustomerId' => '80013554',
            'Str_Check' => '2b1bef9d8ab6a81e9a2739c6ecc64ef8',
        ]);
    }
}
