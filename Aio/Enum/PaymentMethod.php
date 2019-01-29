<?php

namespace Ecpay\Aio\Enum;

/**
 * 付款方式。
 */
abstract class PaymentMethod
{
    /**
     * 不指定付款方式。
     */
    const ALL = 'AllPay';

    /**
     * 信用卡付費。
     */
    const Credit = 'Credit';

    /**
     * 網路 ATM。
     */
    const WebATM = 'WebATM';

    /**
     * 自動櫃員機。
     */
    const ATM = 'ATM';

    /**
     * 超商代碼。
     */
    const CVS = 'CVS';

    /**
     * 超商條碼。
     */
    const BARCODE = 'BARCODE';

    /**
     * AndroidPay。
     */
    const AndroidPay = 'AndroidPay';

}
