<?php

spl_autoload_register(function($class_name){
	$ds = DIRECTORY_SEPARATOR;

	//ManoMano
	if(preg_match('/^ManoMano/', $class_name)){
		$path = str_replace('ManoMano', 'ManoMano\src', $class_name);
		$path = str_replace('\\', $ds, trim($path, '\\'));
		$path = str_replace('ManoMano', '', trim($path, '\\'));
		$file = __DIR__.$path.'.php';
		if(is_file($file)){
			include_once $file;
		}
	}
});