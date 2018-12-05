<?php

use ManoMano\Core\Client;

include_once ('.config.php');
include_once ('../autoload.php');


Client::setLogin(MANO_LOGIN);
Client::setPassword(MANO_PASSWORD);

$method = new \ManoMano\Order\RefuseOrder();
$method->setOrderRef('M1');
$rsp = Client::refuseOrder($method);
var_dump($rsp);