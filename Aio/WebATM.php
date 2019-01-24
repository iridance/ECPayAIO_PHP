<?php

namespace Ecpay\Aio;

/**
 *  付款方式 WebATM
 */
class WebATM extends Verification
{
    public $arPayMentExtend = [];

    //過濾多餘參數
    public function filter_string($arExtend = [], $InvoiceMark = '')
    {
        $arExtend = parent::filter_string($arExtend, $InvoiceMark);
        return $arExtend;
    }
}
