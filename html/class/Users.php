<?php
class Users{

	private $connection;
 
    public function __construct($connection=''){
    	$this->connection 	  = $connection;
		
    }
	
    private function checkSQL(){
		$error = '';
		
		$error = mysql_error();
		
    	if ( $error != ''){
			throw new Exception("(filelog.php)line18 - ".$error);
    	}
		
	}
	
	public function checkIfUserExists($username){
		
		try{
			
	    	//check before if the user doesnt exist in the table
	    	$select = "SELECT count(username) as nb" .
	    			  " FROM users " .
	    			  " WHERE username ='" . strtolower($username) . "'";
	    	
	    	$this->connection->query($select);
	    	$result = $this->connection->fetchNextObject();
	    	 
	    	//check sql 
	    	$this->checkSQL(); 
	    	
	    	if ($result->nb >=1 ){
	    		
	    		return true;
	    	}else{
	    		return false;
	    	}
			
		}
    	catch (Exception $e) {
			$this->log->setWarning($e->getMessage());
		}
		
	}
	
    public function setUser($username){
    
    	try{
	    	
	    	$insert = "INSERT INTO users (username, date)" .
	    			  ' VALUES ("'.strtolower($username).'","'.date('Y-m-d h:i:s').'")';
	    	
	    	$this->connection->query($insert);
	    	
	    	//check sql 
    		$this->checkSQL();
    		
	    	return $this->connection->lastInsertedId();
	    	
    	}
    	catch (Exception $e) {
			$this->log->setWarning($e->getMessage());
		}
		
    }
    
   
	
	
   
}