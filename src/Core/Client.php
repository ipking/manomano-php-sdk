<?php
namespace ManoMano\Core;

/**
 * 订单列表
 */
class Client{
	const SUCCESS_CODE = 0;
	
	public static $url = 'https://ws.monechelle.com/';
	public static $login = '';
	public static $password = '';
	
	public static $last_response = '';
	
	public static function setLogin($login){
		self::$login = $login;
	}
	
	public static function setPassword($password){
		self::$password = $password;
	}
	
	public static function setUrl($url){
		self::$url = $url;
	}
	
	private static function getMethodUrl(Method $request){
		$params = array(
			'login'    => self::$login,
			'password' => self::$password,
			'method'   => $request->method,
		);
		$params = array_merge($params,$request->getParams());
		
		$arr = array();
		foreach($params as $key => $value){
			if(!$value){
				continue;
			}
			$arr[] = $key.'='.$value;
		}
		$url = trim(self::$url, '/').'/?'.join('&', $arr);
		return $url;
	}
	
	/**
	 * 把一个xml串转换成数组
	 * @param $xml
	 * @return array
	 */
	private static function xmlToArray($xml){
		$data = (array)simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		return json_decode(json_encode($data), true);
	}
	
	
	/**
	 * @param $url
	 * @return mixed
	 * @throws \Exception
	 */
	private static function request($url){
		self::$last_response = $rep = Http::curl($url);
		$array = self::xmlToArray($rep);
		if($array[0] ===false || $array['code'] != self::SUCCESS_CODE){
			throw new \Exception('request error: ' . ($array['message']?:''),$array['code']);
		}
		return $array['datas'];
	}
	
	
	/**
	 * @param \ManoMano\Core\Method $request
	 * @return mixed
	 * @throws \Exception
	 */
	public static function getOrderList(Method $request){
		return self::execute($request);
	}
	
	/**
	 * @param \ManoMano\Core\Method $request
	 * @return mixed
	 * @throws \Exception
	 */
	public static function acceptOrder(Method $request){
		return self::execute($request);
	}
	
	/**
	 * @param \ManoMano\Core\Method $request
	 * @return mixed
	 * @throws \Exception
	 */
	public static function refuseOrder(Method $request){
		return self::execute($request);
	}
	/**
	 * @param \ManoMano\Core\Method $request
	 * @return mixed
	 * @throws \Exception
	 */
	public static function getLastOrders(Method $request){
		return self::execute($request);
	}
	/**
	 * @param \ManoMano\Core\Method $request
	 * @return mixed
	 * @throws \Exception
	 */
	public static function createShipping(Method $request){
		return self::execute($request);
	}
	
	/**
	 * @param \ManoMano\Core\Method $request
	 * @return mixed
	 * @throws \Exception
	 */
	public static function createRefund(Method $request){
		return self::execute($request);
	}
	
	/**
	 * @param \ManoMano\Core\Method $request
	 * @return mixed
	 * @throws \Exception
	 */
	public static function addInvoice(Method $request){
		return self::execute($request);
	}
	
	/**
	 * @param \ManoMano\Core\Method $request
	 * @return mixed
	 * @throws \Exception
	 */
	public static function execute(Method $request){
		$url = self::getMethodUrl($request);
		return $request->execute(self::request($url));
	}
	
	
}