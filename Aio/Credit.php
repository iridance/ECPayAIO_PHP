<?php

namespace Ecpay\Aio;

/**
* 付款方式 : 信用卡
*/
class Credit extends Verification
{
    public $arPayMentExtend = [
        "CreditInstallment" => '',
        "InstallmentAmount" => 0,
        "Redeem"            => false,
        "UnionPay"          => false,
        "Language"          => '',
        "BidingCard"        => '',
        "MerchantMemberID"  => '',
        "PeriodAmount"      => '',
        "PeriodType"        => '',
        "Frequency"         => '',
        "ExecTimes"         => '',
        "PeriodReturnURL"   => '',
    ];

    public function filter_string($arExtend = [], $InvoiceMark = '')
    {
        $arExtend = parent::filter_string($arExtend, $InvoiceMark);
        return $arExtend;
    }
}
