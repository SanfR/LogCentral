<?php
class Filelogs{
	
	public $arrayFile = array() ;
	public $userid;
	public $connection;
	public $log;
	
	public function __construct($userid, $connection, $log){
		Try{
			$this->log = $log;
			$this->checkUserID($userid,'construct line10');
			
			$this->userid = $userid;
			$this->connection = $connection;
			
		}catch (Exception $e) {
		   $this->log->setWarning($e->getMessage());
		}
	}
	
	//return nothing, just call $nameclass->arrayFile
	public function getFilelog(){
		
		Try{
			
			$select = " SELECT id, file_name, delimiter, us_id " .
				  " FROM files" .
				  " WHERE us_id=" . $this->userid;
			$this->connection->query($select);
			
			//check sql 
		    $this->connection->checkSQL();
		    	
			while($result = $this->connection->fetchNextObject()){
				if (!in_array($result->id, $this->arrayFile)){
					$this->arrayFile[] = new Filelog($result->id, $result->file_name, $result->delimiter , $result->us_id);
				}
			}
			
		}catch (Exception $e) {
		   $this->log->setWarning($e->getMessage());
		}
		
	}
	
	public function setFilelog( $delimiter,$path ){
		try{
			
			
			//then add to the table files
			$insert = 'INSERT INTO files (file_name, delimiter, us_id)' .
	    			  ' VALUES ("'.strtolower($path).'","'.$delimiter.'",'.$this->userid.' )';
	    	
	    	$this->connection->query($insert);
	    	
	    	//check sql 
	    	$this->connection->checkSQL('set file log '.$insert);
	    	
	    	return true;
		
		}catch (Exception $e) {
			$this->log->setWarning($e->getMessage());
		}
	}
	

	//check if the userid is numeric
	private function checkUserID ($userid, $namefunction=''){
		
		if (  !is_numeric($userid)){
			throw new Exception("(filelogs.php)line70 - ".$namefunction." the userid is not in a validable format.");
		}
		
	}
	
	public function deleteFilelog($idFile){
		try{
			
			
			//then add to the table files
			$delete = 'DELETE FROM files ' .
	    			  ' WHERE id ='.$idFile ;
	    	
	    	$this->connection->query($delete);
	    	
	    	//check sql 
	    	$this->connection->checkSQL('delete file log '.$delete);
	    	
	    	return true;
		
		}catch (Exception $e) {
			$this->log->setWarning($e->getMessage());
		}
	}
	
//return nothing, just call $nameclass->arrayFile
	public function getLogs($fiId){
		
		Try{
			$result = array();
			$select = "SELECT id, line, fi_id " .
				  " FROM resultimport" .
				  " WHERE us_id=" . $fiId;
			$this->connection->query($select);
			
			//check sql 
		    $this->connection->checkSQL();
		    	$i=0;
			while($result = $this->connection->fetchNextObject()){
				
				$result[$i]['id']   = $result->id;
				$result[$i]['line'] = $result->line;
				$result[$i]['fi_id']= $result->fi_id;
				$i++;
			}
			return $result;
		}catch (Exception $e) {
		   $this->log->setWarning($e->getMessage());
		}
		
	}
}