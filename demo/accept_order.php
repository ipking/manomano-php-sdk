<?php

use ManoMano\Core\Client;

include_once ('.config.php');
include_once ('../autoload.php');


Client::setLogin(MANO_LOGIN);
Client::setPassword(MANO_PASSWORD);

$method = new \ManoMano\Order\AcceptOrder();
$method->setOrderRef('M1');
$rsp = Client::acceptOrder($method);
var_dump($rsp);