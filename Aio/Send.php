<?php

namespace Ecpay\Aio;

/**
 *  產生訂單
 */
class Send extends Common
{
    //付款方式物件
    public static $PaymentObj;

    protected static function process($arParameters = [], $arExtend = [])
    {
        //宣告付款方式物件
        $PaymentMethod = $arParameters['ChoosePayment'];

        self::$PaymentObj = new $PaymentMethod;

        //檢查參數
        $arParameters = self::$PaymentObj->check_string($arParameters);

        //檢查商品
        $arParameters = self::$PaymentObj->check_goods($arParameters);

        //檢查各付款方式的額外參數&電子發票參數
        $arExtend = self::$PaymentObj->check_extend_string($arExtend, $arParameters['InvoiceMark']);

        //過濾
        $arExtend = self::$PaymentObj->filter_string($arExtend, $arParameters['InvoiceMark']);

        //合併共同參數及延伸參數
        return array_merge($arParameters, $arExtend);
    }

    public static function CheckOut($target = "_self", $arParameters = [], $arExtend = [], $HashKey = '', $HashIV = '', $ServiceURL = '')
    {

        $arParameters = self::process($arParameters, $arExtend);
        //產生檢查碼
        $szCheckMacValue = CheckMacValue::generate($arParameters, $HashKey, $HashIV, $arParameters['EncryptType']);

        //生成表單，自動送出
        $szHtml = '<!DOCTYPE html>';
        $szHtml .= '<html>';
        $szHtml .= '<head>';
        $szHtml .= '<meta charset="utf-8">';
        $szHtml .= '</head>';
        $szHtml .= '<body>';
        $szHtml .= "<form id=\"__ecpayForm\" method=\"post\" target=\"{$target}\" action=\"{$ServiceURL}\">";

        foreach ($arParameters as $keys => $value) {
            $szHtml .= "<input type=\"hidden\" name=\"{$keys}\" value=\"{$value}\" />";
        }

        $szHtml .= "<input type=\"hidden\" name=\"CheckMacValue\" value=\"{$szCheckMacValue}\" />";
        $szHtml .= '</form>';
        $szHtml .= '<script type="text/javascript">document.getElementById("__ecpayForm").submit();</script>';
        $szHtml .= '</body>';
        $szHtml .= '</html>';

        echo $szHtml;
        exit;
    }

    public static function CheckOutString($paymentButton, $target = "_self", $arParameters = [], $arExtend = [], $HashKey = '', $HashIV = '', $ServiceURL = '')
    {

        $arParameters = self::process($arParameters, $arExtend);
        //產生檢查碼
        $szCheckMacValue = CheckMacValue::generate($arParameters, $HashKey, $HashIV, $arParameters['EncryptType']);

        $szHtml = '<!DOCTYPE html>';
        $szHtml .= '<html>';
        $szHtml .= '<head>';
        $szHtml .= '<meta charset="utf-8">';
        $szHtml .= '</head>';
        $szHtml .= '<body>';
        $szHtml .= "<form id=\"__ecpayForm\" method=\"post\" target=\"{$target}\" action=\"{$ServiceURL}\">";

        foreach ($arParameters as $keys => $value) {
            $szHtml .= "<input type=\"hidden\" name=\"{$keys}\" value=\"{$value}\" />";
        }

        $szHtml .= "<input type=\"hidden\" name=\"CheckMacValue\" value=\"{$szCheckMacValue}\" />";
        $szHtml .= "<input type=\"submit\" id=\"__paymentButton\" value=\"{$paymentButton}\" />";
        $szHtml .= '</form>';
        $szHtml .= '</body>';
        $szHtml .= '</html>';
        return $szHtml;
    }

}
