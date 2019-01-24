<?php

namespace Ecpay\EInvoice\Enum;

// 交易類別
abstract class PayTypeCategory
{
    // ECBANK
    const Ecbank = '1';

    // ECPAY
    const Ecpay = '2';

    // ALLPAY
    const Allpay = '3';
}
