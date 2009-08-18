<?php
class Logs{
	
	public $logger;
	public $redacteur;
	
	public function __construct ($file){
		
		
		$this->redacteur = new Zend_Log_Writer_Stream($file);	 
		$this->logger    = new Zend_Log($this->redacteur);
		
	}
	
	public function setInfo($message){
		$this->logger->info("Message d'information");
	}

	public function setWarning($message){
		$this->logger->warn($message);
	}
	
}