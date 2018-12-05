<?php
namespace ManoMano\Core;

/**
 * 方法
 */
abstract class Method{
	public $method;
	
	/**
	 * 执行
	 * @param $rsp
	 */
	abstract public function execute($rsp);
	
	/**
	 * 获取参数
	 */
	abstract public function getParams();
}