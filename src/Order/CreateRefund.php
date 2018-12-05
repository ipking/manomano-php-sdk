<?php
namespace ManoMano\Order;

use ManoMano\Core\Method;

/**
 * 创建退款
 */
class CreateRefund extends Method{
	public $method = 'create_refund';
	protected $order_ref;
	protected $sku;
	protected $quantity;
	//以下参数可选
	protected $shipping_price;
	
	public function setOrderRef($order_ref){
		$this->order_ref = $order_ref;
	}
	
	public function setSku($sku){
		$this->sku = $sku;
	}
	
	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}
	
	public function setShippingPrice($shipping_price){
		$this->shipping_price = $shipping_price;
	}
	
	/**
	 * 执行
	 * @param array $data_array
	 * @return mixed
	 */
	public function execute($data_array){
		return true;
	}
	
	/**
	 * 获取参数
	 */
	public function getParams(){
		if(!$this->order_ref){
			throw new \Exception('Params error: order_ref can not be empty.');
		}
		if(!$this->sku){
			throw new \Exception('Params error: sku can not be empty.');
		}
		if(!$this->quantity){
			throw new \Exception('Params error: quantity can not be empty.');
		}
		$params['order_ref'] = $this->order_ref;
		$params['sku'] = $this->sku;
		$params['quantity'] = $this->quantity;
		$params['shipping_price'] = $this->shipping_price;
		return $params;
	}
}