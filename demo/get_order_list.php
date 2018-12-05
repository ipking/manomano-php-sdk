<?php

use ManoMano\Core\Client;

include_once ('.config.php');
include_once ('../autoload.php');

Client::setLogin(MANO_LOGIN);
Client::setPassword(MANO_PASSWORD);

$method = new \ManoMano\Order\OrderList();
$rsp = Client::getOrderList($method);
var_dump($rsp);