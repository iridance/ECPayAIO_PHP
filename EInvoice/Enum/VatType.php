<?php

namespace Ecpay\EInvoice\Enum;

// 商品單價是否含稅
abstract class VatType
{
    // 商品單價含稅價
    const Yes = '1';

    // 商品單價未稅價
    const No = '0';
}
