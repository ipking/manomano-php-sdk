<?php

use ManoMano\Core\Client;

include_once ('.config.php');
include_once ('../autoload.php');


Client::setLogin(MANO_LOGIN);
Client::setPassword(MANO_PASSWORD);

$method = new \ManoMano\Order\AddInvoice();
$method->setOrderRef('M1');
$method->setInvoice('http://www.marchand.com/invoice.pdf');
$rsp = Client::addInvoice($method);
var_dump($rsp);