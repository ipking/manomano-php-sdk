<?php
namespace ManoMano\Order;

use ManoMano\Core\Method;

/**
 * 订单列表
 */
class OrderList extends Method{
	public $method = 'get_orders';
	
	/**
	 * 执行
	 * @param array $data_array
	 * @return mixed
	 */
	public function execute($data_array){
		if(!$data_array){
			return array();
		}
		$list = $data_array['order'];
		//判断是否只有一个订单
		if(isset($data_array['order']['order_ref'])){
			$list = array($data_array['order']);
		}
		foreach($list as $key => $order){
			//判断只有一个sku 还是多个
			if(isset($order['products']['product']['sku'])){
				//一个sku
				$list[$key]['products'][] = $order['products']['product'];
				unset($list[$key]['products']['product']);
			}else{
				//多个sku
				$list[$key]['products'] = $order['products']['product'];
			}
			
			$list[$key]['shipping_address'] = $this->address($list[$key]['shipping_address']);
			
		}
		return $list;
	}
	
	private function address($address){
		$address['company'] = $address['company']?:'';
		$address['region_1'] = $address['region_1']?:'';
		$address['region_2'] = $address['region_2']?:'';
		$address['region_3'] = $address['region_3']?:'';
		
		$fields = array(
			'address_1',
			'address_2',
			'address_3',
		);
		foreach($fields as $field){
			if($address[$field] and is_array($address[$field])){
				$address[$field] = join(',',$address[$field]);
			}
		}
		$address['company'] = $address['company']?trim($address['company']):'';
		$address['region_1'] = $address['region_1']?trim($address['region_1']):'';
		$address['region_2'] = $address['region_2']?trim($address['region_2']):'';
		$address['region_3'] = $address['region_3']?trim($address['region_3']):'';
		$address['address_1'] = $address['address_1']?trim($address['address_1']):'';
		$address['address_2'] = $address['address_2']?trim($address['address_2']):'';
		$address['address_3'] = $address['address_3']?trim($address['address_3']):'';
		return $address;
	}
	
	/**
	 * 获取参数
	 */
	public function getParams(){
		return array();
	}
}