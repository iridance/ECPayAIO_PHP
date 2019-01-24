<?php

namespace Ecpay\Aio\Enum;

/**
 * 信用卡訂單處理動作資訊。
 */
abstract class ActionType
{
    /**
     * 關帳
     */
    const C = 'C';

    /**
     * 退刷
     */
    const R = 'R';

    /**
     * 取消
     */
    const E = 'E';

    /**
     * 放棄
     */
    const N = 'N';
}