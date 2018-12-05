<?php

use ManoMano\Core\Client;

include_once ('.config.php');
include_once ('../autoload.php');


Client::setLogin(MANO_LOGIN);
Client::setPassword(MANO_PASSWORD);

$method = new \ManoMano\Order\CreateRefund();
$method->setOrderRef('M1');
$method->setSku('Mk001');
$method->setQuantity('10');
//可选参数
$method->setShippingPrice('10.00');
$rsp = Client::createRefund($method);
var_dump($rsp);