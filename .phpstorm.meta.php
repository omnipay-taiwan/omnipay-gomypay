<?php

namespace PHPSTORM_META {

    /** @noinspection PhpIllegalArrayKeyTypeInspection */
    /** @noinspection PhpUnusedLocalVariableInspection */
    $STATIC_METHOD_TYPES = [
      \Omnipay\Omnipay::create('') => [
        'Gomypay' instanceof \Omnipay\Gomypay\Gateway,
      ],
      \Omnipay\Common\GatewayFactory::create('') => [
        'Gomypay' instanceof \Omnipay\Gomypay\Gateway,
      ],
    ];
}
