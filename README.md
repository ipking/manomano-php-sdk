# 关于
ManoMano 平台  PHP api for https://www.manomano.com


# 目录 
```
├── src // API 接口
│   ├── Model // API接口需要使用到的一些数据结构
│   ├── Core //API接口的关键逻辑
│   ├── Error //异常错误类
│   └── Order // 订单类方法
└── demo // API接口的测试用例
    ├── .config.php //测试用例的配置信息
    └── get_last_orders.php 等等// 具体的api测试用例
```
# 用法
```php
<?php

use ManoMano\Core\Client;

include_once ('.config.php');
include_once ('../autoload.php');

Client::setLogin(MANO_LOGIN);
Client::setPassword(MANO_PASSWORD);

$method = new \ManoMano\Order\OrderList();
$rsp = Client::getOrderList($method);
var_dump($rsp);
```
