<?php

namespace Ecpay\Aio;

/**
 * 付款方式 : Android Pay
 */
class AndroidPay extends Verification
{
    public $arPayMentExtend = [];

    public function filter_string($arExtend = [], $InvoiceMark = '')
    {
        $arExtend = parent::filter_string($arExtend, $InvoiceMark);
        return $arExtend;
    }
}
