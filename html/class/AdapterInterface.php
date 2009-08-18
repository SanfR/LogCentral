<?php
/*
 * Becareful if you change this interface
 * it uses for gummo (debug) and userController
 */

class AdapterInterface implements Zend_Auth_Adapter_Interface {
	

    protected $Identity = null; 	   
    
	
    protected $Rows = null;
    public  $user;
     
    public function __construct($identity,  $rows) 	  
    { 	    
       $this->Identity   = $identity; 	
        
       $this->Rows = $rows;	
    } 	    
	

    public function setIdentity($value) 	  
    { 	    
        $this->Identity = $value; 	    
        return $this; 	      
    } 	    
	
  
    
	 public function setRows($value) 
    { 	   
        $this->Rows = $value; 	        
        return $this; 	        
    }
    
    public function getrows(){
    	return $this->Rows;
    }
  
    public function authenticate() 	   
    { 	   
        $exception = null; 	 
        $result    = array( 	 
            'code'     => Zend_Auth_Result::FAILURE, 	 
            'identity'  => $this->Identity, 	 
            'messages' => array() 	 
        ); 	 
  	 	
  	 	$exception = 'You must provide a credential to authenticate'; 	
        $result['code']= Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND; 	        
      	$result['messages'][] = 'Authentication failed'; 
      		
        if (empty($this->Identity)) { 
        	echo "1";
        	$exception = 'You must provide a identity to authenticate'; 	            
          //  throw new Zend_Auth_Adapter_Exception('Please verify your username');
            
        } elseif($this->Rows){
    	
			$this->user = new stdClass();
			foreach($this->Rows as $key => $values){
				$this->user->$key = $values;
			}
			$this->user->active = 1;
			$found = true;
			$exception = null;
			$result['code']       = Zend_Auth_Result::SUCCESS; 	        
        	$result['messages'][] = 'Authentication success'; 
    	}
  	  return new Zend_Auth_Result($result['code'], $result['identity'], $result['messages'],$this->user);
	}
	
	
	
}
?>