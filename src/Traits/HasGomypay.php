<?php

namespace Omnipay\Gomypay\Traits;

use Omnipay\Gomypay\Hasher;

trait HasGomypay
{
    public function getCustomerId()
    {
        return $this->getParameter('CustomerId');
    }

    /**
     * 商店代號
     * 法人：統編或加密之商店代號 32 碼
     * 自然人：身分證或加密之商店代號 32 碼
     */
    public function setCustomerId($value)
    {
        return $this->setParameter('CustomerId', $value);
    }

    public function getStrCheck()
    {
        return $this->getParameter('Str_Check');
    }

    /**
     * 交易驗證密碼，如果檢查不符合無法交易(使用 Json 回傳才為必填欄位)
     */
    public function setStrCheck($value)
    {
        return $this->setParameter('Str_Check', $value);
    }

    public function getStr_Check()
    {
        return $this->getStrCheck();
    }

    /**
     * 交易驗證密碼，如果檢查不符合無法交易(使用 Json 回傳才為必填欄位)
     */
    public function setStr_Check($value)
    {
        return $this->setStrCheck($value);
    }

    public function makeHash(array $data)
    {
        return (new Hasher($this->getCustomerId(), $this->getStrCheck()))->make($data);
    }
}
