<?php

use PHPUnit\Framework\TestCase;

use Ecpay\Aio\AllInOne;

class AllInOneTest extends TestCase
{
    public function testCreateOrder()
    {
        $obj = new AllInOne;
   
        //服務參數
        $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";  //服務位置
        $obj->HashKey     = '5294y06JbISpM5x9' ;                                          //測試用Hashkey，請自行帶入ECPay提供的HashKey
        $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                          //測試用HashIV，請自行帶入ECPay提供的HashIV
        $obj->MerchantID  = '2000132';                                                    //測試用MerchantID，請自行帶入ECPay提供的MerchantID
        $obj->EncryptType = '1';                                                          //CheckMacValue加密類型，請固定填入1，使用SHA256加密

        //基本參數(請依系統規劃自行調整)
        $MerchantTradeNo = Date('Ymd').time() ;
        $obj->Send['ReturnURL']         = "http://www.ecpay.com.tw/receive.php" ;     //付款完成通知回傳的網址
        $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;                           //訂單編號
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                        //交易時間
        $obj->Send['TotalAmount']       = 2000;                                       //交易金額
        $obj->Send['TradeDesc']         = "good to drink" ;                           //交易描述
        $obj->Send['ChoosePayment']     = \Ecpay\Aio\Enum\PaymentMethod::ALL;         //付款方式:全功能

        //訂單的商品資料
        array_push(
            $obj->Send['Items'],
            [
                'Name' => "歐付寶黑芝麻豆漿",
                'Price' => 2000,
                'Currency' => "元",
                'Quantity' => 1,
                'URL' => "product-url"
            ]
        );

        # 電子發票參數
        /*
        $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
        $obj->SendExtend['RelateNumber'] = "Test".time();
        $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
        $obj->SendExtend['CustomerPhone'] = '0911222333';
        $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
        $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
        $obj->SendExtend['InvoiceItems'] = array();
        // 將商品加入電子發票商品列表陣列
        foreach ($obj->Send['Items'] as $info)
        {
            array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => ECPay_TaxType::Dutiable));
        }
        $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
        $obj->SendExtend['DelayDay'] = '0';
        $obj->SendExtend['InvType'] = ECPay_InvType::General;
        */


        //產生訂單(取得訂單自動結帳頁面html)
        $result = $obj->CheckOutString();

        if (empty($result) !== true) { //修改內容為xml dom可讀格式
            $result = str_replace('<!DOCTYPE html>', '', $result);
            $result = str_replace('<meta charset="utf-8">', '<meta charset="utf-8"/>', $result);
        }

        $expected = new \DOMDocument;
        $expected->loadXML($result);

        $actual = new \DOMDocument;
        $actual->loadXML(
            '<html>
            <head>
                <meta charset="utf-8" />
            </head>
            <body>
                <form id="__ecpayForm">
                    <input type="hidden" name="MerchantID" />
                    <input type="hidden" name="EncryptType" />
                    <input type="hidden" name="ReturnURL" />
                    <input type="hidden" name="ClientBackURL" />
                    <input type="hidden" name="OrderResultURL" />
                    <input type="hidden" name="MerchantTradeNo" />
                    <input type="hidden" name="MerchantTradeDate" />
                    <input type="hidden" name="PaymentType" />
                    <input type="hidden" name="TotalAmount" />
                    <input type="hidden" name="TradeDesc" />
                    <input type="hidden" name="ChoosePayment" />
                    <input type="hidden" name="Remark" />
                    <input type="hidden" name="ChooseSubPayment" />
                    <input type="hidden" name="NeedExtraPaidInfo" />
                    <input type="hidden" name="DeviceSource" />
                    <input type="hidden" name="InvoiceMark" />
                    <input type="hidden" name="StoreID" />
                    <input type="hidden" name="CustomField1" />
                    <input type="hidden" name="CustomField2" />
                    <input type="hidden" name="CustomField3" />
                    <input type="hidden" name="CustomField4" />
                    <input type="hidden" name="HoldTradeAMT" />
                    <input type="hidden" name="ItemURL" />
                    <input type="hidden" name="ItemName" />
                    <input type="hidden" name="CheckMacValue" />
                    <input type="submit" id="__paymentButton" />
                </form>
            </body>
            </html>'
        );

        $this->assertEqualXMLStructure(
            $expected->firstChild, $actual->firstChild
        );
    }

    /* public function allPayProvider()
    {
        return [

        ];
    } */
}