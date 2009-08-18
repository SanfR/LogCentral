<?php
class Common{

	

  	public function protectSQL($param){
    	
    	$param = $this->cleanString($param);
    	return mysql_real_escape_string($param);
    }
    
    //Clean one variable - trim - lowercase
    public function cleanString($string){
    	$string = trim($string);
    	return $string = strtolower($string);
    }
}