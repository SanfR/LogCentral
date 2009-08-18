<?php
/*
Function qui permet de charger toutes les classes
*/


function __autoload($class_name) {


	if (preg_match("/Zend/i", $class_name)){
		
		$class_name=str_replace('_','/',$class_name);
		if (file_exists(dirname(__FILE__)."/".$class_name.'.php')){
			require_once dirname(__FILE__)."/".$class_name.'.php';
		}
	 
	}elseif(file_exists(dirname(__FILE__).'/class/'.$class_name.'.php')){
	
		require_once dirname(__FILE__).'/class/'.$class_name.'.php';
	}
  
}
?>