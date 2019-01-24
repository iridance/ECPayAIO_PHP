<?php

namespace Ecpay\Aio;

/**
 *  付款方式：全功能
 */
class AllPay extends Verification
{
    public $arPayMentExtend = [];

    public function filter_string($arExtend = [], $InvoiceMark = '')
    {
        return $arExtend;
    }
}
