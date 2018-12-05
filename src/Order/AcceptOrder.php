<?php
namespace ManoMano\Order;

use ManoMano\Core\Method;

/**
 * 接受订单
 */
class AcceptOrder extends Method{
	public $method = 'accept_order';
	protected $order_ref;
	
	public function setOrderRef($order_ref){
		$this->order_ref = $order_ref;
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
		$params['order_ref'] = $this->order_ref;
		return $params;
	}
}