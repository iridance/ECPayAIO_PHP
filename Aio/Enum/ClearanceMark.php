<?php

namespace Ecpay\Aio\Enum;

/**
 * 通關方式
 */
abstract class ClearanceMark
{
    // 經海關出口
    const Yes = '1';

    // 非經海關出口
    const No = '2';
}
