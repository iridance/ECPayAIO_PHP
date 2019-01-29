綠界sdk composer 版本
======================

舊版本不支援現代化的composer套件管理模式，所以簡單的修改成composer版本，可供所有php framework使用

Installation
------------
### 從 Composer 安裝
php composer.phar require mdmsoft/yii2-admin:dev-master

Sample
------------
use Ecpay\Aio\AllInOne;

$payment = new AllInOne;

...

...

$payment->CheckOut();

未完成
------------
ApplePaySDK

PayLogisticSDK

unit test

Require
------------
PHP >= 5.4
