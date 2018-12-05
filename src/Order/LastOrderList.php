<?php
namespace ManoMano\Order;

use ManoMano\Core\Method;

/**
 * 获取最近订单列表
 */
class LastOrderList extends Method{
	public $method = 'get_last_orders';
	protected $update_time_start;
	protected $update_time_end;
	
	public function setUpdateTimeStart($update_time_start){
		$this->update_time_start = $update_time_start;
	}
	
	public function setUpdateTimeEnd($update_time_end){
		$this->update_time_end = $update_time_end;
	}
	
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
		if(!$this->update_time_start){
			throw new \Exception('Params error: update_time_start can not be empty.');
		}
		if(!$this->update_time_end){
			throw new \Exception('Params error: update_time_end can not be empty.');
		}
		$params['update_time_start'] = $this->update_time_start;
		$params['update_time_end'] = $this->update_time_end;
		return $params;
	}
}