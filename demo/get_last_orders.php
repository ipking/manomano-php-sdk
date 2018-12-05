<?php

use ManoMano\Core\Client;

include_once ('.config.php');
include_once ('../autoload.php');


Client::setLogin(MANO_LOGIN);
Client::setPassword(MANO_PASSWORD);

$method = new \ManoMano\Order\LastOrderList();
$method->setUpdateTimeStart('2018-11-14');
$method->setUpdateTimeEnd('2018-11-27');
$rsp = Client::getLastOrders($method);
var_dump($rsp);