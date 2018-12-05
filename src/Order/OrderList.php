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
			return [];
		}
		$list = $data_array['order'];
		//判断是否只有一个订单
		if(isset($data_array['order']['order_ref'])){
			$list = [$data_array['order']];
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
			
		}
		return $list;
	}
	
	/**
	 * 获取参数
	 */
	public function getParams(){
		return [];
	}
}