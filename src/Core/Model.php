<?php
namespace ManoMano\Core;

/**
 * Model
 */
abstract class Model{
	
	/**
	 * 设置属性
	 * @param array $params
	 */
	abstract public function setValues($params);
	
	/**
	 * 获取属性
	 */
	abstract public function getParams();
}