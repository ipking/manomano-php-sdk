<?php
namespace ManoMano\Order;

use ManoMano\Core\Method;
use ManoMano\Core\Model;

/**
 * 上传跟踪号
 */
class CreateShipping extends Method{
	public $method = 'create_shipping';
	protected $order_ref;
	protected $tracking_number;
	
	//以下为可选参数
	protected $tracking_url;
	protected $carrier;
	protected $products = [];
	protected $shipping_date;
	protected $estimated_delivery_date;
	
	public function setOrderRef($order_ref){
		$this->order_ref = $order_ref;
	}
	
	public function setTrackingNumber($tracking_number){
		$this->tracking_number = $tracking_number;
	}
	
	public function setTrackingUrl($tracking_url){
		if(!$tracking_url){
			return;
		}
		$this->tracking_url = urlencode($tracking_url);
	}
	
	public function setCarrier($carrier){
		$this->carrier = $carrier;
	}
	
	public function setShippingDate($shipping_date){
		$this->shipping_date = $shipping_date;
	}
	
	public function setEstimatedDeliveryDate($estimated_delivery_date){
		$this->estimated_delivery_date = $estimated_delivery_date;
	}
	
	public function addProduct(Model $product){
		/**@var \ManoMano\Model\ShippingProduct $product*/
		if(!$product->sku){
			throw new \Exception('Params error: product sku can not be empty.');
		}
		if(!$product->quantity){
			throw new \Exception('Params error: product quantity can not be empty.');
		}
		$this->products[] = $product;
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
		if(!$this->tracking_number){
			throw new \Exception('Params error: tracking_number can not be empty.');
		}
		$params['order_ref'] = $this->order_ref;
		$params['tracking_number'] = $this->tracking_number;
		$params['tracking_url'] = $this->tracking_url;
		$params['carrier'] = $this->carrier;
		$params['shipping_date'] = $this->shipping_date;
		$params['estimated_delivery_date'] = $this->estimated_delivery_date;
		/**@var \ManoMano\Model\ShippingProduct $product*/
		foreach($this->products as $key => $product){
			$k = $key+1;
			$params['products['.$k.'][sku]'] = $product->sku;
			$params['products['.$k.'][quantity]'] = $product->quantity;
		}
		return $params;
	}
}