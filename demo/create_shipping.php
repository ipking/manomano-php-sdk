<?php

use ManoMano\Core\Client;

include_once ('.config.php');
include_once ('../autoload.php');


Client::setLogin(MANO_LOGIN);
Client::setPassword(MANO_PASSWORD);

$method = new \ManoMano\Order\CreateShipping();
$method->setOrderRef('M1');
$method->setTrackingNumber('2018');
//以下参数可选
$method->setTrackingUrl('http://www.baidu.com/2018');
$method->setCarrier('DHL承运商');
$method->setShippingDate('2018-11-27');
$method->setEstimatedDeliveryDate('2018-11-30');

$product = new \ManoMano\Model\ShippingProduct();
$product->setValues([
	'sku'      => 'MK001',
	'quantity' => '2',
]);
$method->addProduct($product);
$rsp = Client::createShipping($method);
var_dump($rsp);