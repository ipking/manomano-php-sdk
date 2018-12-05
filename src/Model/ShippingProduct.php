<?php

namespace ManoMano\Model;

use ManoMano\Core\Model;

class ShippingProduct extends Model{
	
	public $sku;
	public $quantity;
	
	public function setValues($param){
		$this->sku = $param['sku'];
		$this->quantity = $param['quantity'];
	}
	
	public function getParams(){
		$params['sku'] = $this->sku;
		$params['quantity'] = $this->quantity;
		return $params;
	}
}
