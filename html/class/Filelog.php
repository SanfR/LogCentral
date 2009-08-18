<?php
class Filelog{
	
	public $id;
	public $file_name;
	public $delimiter;
	public $us_id;
	
	
	public function __construct($id, $filename, $delimiter,$usid){
		$this->id        = $id ;
		$this->file_name = $filename ;
		$this->delimiter = $delimiter;
		$this->us_id     = $usid;
	}
	
}