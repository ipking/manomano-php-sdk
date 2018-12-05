<?php
namespace ManoMano\Core;

class Http
{
	public static $connectTimeout = 30000;//30 second
	public static $readTimeout = 80000;//80 second
	
	public static function curl($url, $httpMethod = "GET", $postFields = null,$headers = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpMethod);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($postFields) ? http_build_query($postFields) : $postFields);
		
		if (self::$readTimeout) {
			curl_setopt($ch, CURLOPT_TIMEOUT, self::$readTimeout);
		}
		if (self::$connectTimeout) {
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$connectTimeout);
		}
		//https request
		if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}
		if (is_array($headers) && 0 < count($headers))
		{
			$httpHeaders =self::getHttpHeader($headers);
			curl_setopt($ch,CURLOPT_HTTPHEADER,$httpHeaders);
		}
		
		$response = curl_exec($ch);
		if (curl_errno($ch))
		{
			throw new \Exception('Curl error: ' . curl_error($ch));
		}
		curl_close($ch);
		return $response;
	}
	
	static function getHttpHeader($headers)
	{
		$httpHeader = array();
		foreach ($headers as $key => $value)
		{
			array_push($httpHeader, $key.":".$value);	
		}
		return $httpHeader;
	}
}