<?php

namespace Ecpay\EInvoice\Enum;

// 電子發票載具類別
abstract class CarruerType
{
    // 無載具
    const None = '';

    // 會員載具
    const Member = '1';

    // 買受人自然人憑證
    const Citizen = '2';

    // 買受人手機條碼
    const Cellphone = '3';
}
