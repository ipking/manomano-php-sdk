<?php
namespace ManoMano\Order;

use ManoMano\Core\Method;

/**
 * 添加订单发票下载地址
 */
class AddInvoice extends Method{
	public $method = 'add_invoice';
	protected $order_ref;
	protected $invoice;
	
	public function setOrderRef($order_ref){
		$this->order_ref = $order_ref;
	}
	
	public function setInvoice($invoice){
		if(!$invoice){
			return;
		}
		$this->invoice = urlencode($invoice);
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
		if(!$this->invoice){
			throw new \Exception('Params error: invoice can not be empty.');
		}
		$params['order_ref'] = $this->order_ref;
		$params['invoice'] = $this->invoice;
		return $params;
	}
}