<?php

namespace Ecpay\Aio;

class QueryPeriodCreditCardTradeInfo extends BaseAio
{
    public static function CheckOut($arParameters = [], $HashKey = '', $HashIV = '', $ServiceURL = '')
    {
        $arErrors                  = [];
        $arParameters['TimeStamp'] = time();
        $arFeedback                = [];
        $arConfirmArgs             = [];

        $EncryptType = $arParameters["EncryptType"];
        unset($arParameters["EncryptType"]);

        // 呼叫查詢。
        if (sizeof($arErrors) == 0) {
            $arParameters["CheckMacValue"] = CheckMacValue::generate($arParameters, $HashKey, $HashIV, $EncryptType);
            // 送出查詢並取回結果。
            $szResult = parent::ServerPost($arParameters, $ServiceURL);
            $szResult = str_replace(' ', '%20', $szResult);
            $szResult = str_replace('+', '%2B', $szResult);

            // 轉結果為陣列。
            $arResult = json_decode($szResult, true);
            // 重新整理回傳參數。
            foreach ($arResult as $keys => $value) {
                $arFeedback[$keys] = $value;
            }

        }

        if (sizeof($arErrors) > 0) {
            throw new \Exception(join('- ', $arErrors));
        }

        return $arFeedback;
    }
}
