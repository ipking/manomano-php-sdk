<?php

spl_autoload_register(function($class_name){
	$ds = DIRECTORY_SEPARATOR;

	//ManoMano
	if(preg_match('/^ManoMano/', $class_name)){
		$path = str_replace('ManoMano', 'ManoMano\src', $path);
		$path = str_replace('\\', $ds, trim($class_name, '\\'));
		$file = str_replace('ManoMano','',__DIR__).$path.'.php';
		if(is_file($file)){
			include_once $file;
		}
	}
});