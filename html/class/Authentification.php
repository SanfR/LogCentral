<?php
class Authentification{
	
	public function __construct(){
		
	}
	
	//if the user is logged
	public function isLoggedIn()
    { 
        $auth = Zend_Auth::getInstance();
		return $auth->getIdentity();
    }
	
 //check if the user exists in database or not
	public function isUser($post, $connection){
		
		//protection sql
		$common = new Common();
		
 		$username = strtolower($common->protectSQL( $post['username']));
 		
		//if its a good user 
		//put his data in Auth-instance
	 	$select = " SELECT id, username, date  " . 
				  " FROM users " .
				  " WHERE username ='" . $username  ."'"  ;
	
	
		$connection->query($select);
		$result = $connection->fetchNextObject();

		$adapter = new AdapterInterface($username,$result);

		$auth = Zend_Auth::getInstance();
	    $authResult = $auth->authenticate($adapter);
	    
	    //valid username and password
        if ($authResult->isValid()){	
        	
			//returns an object
        	$userInfo = $adapter->user;
        	
            if ($userInfo->active==1){
            	//save data in Zend_auth
            	$auth->getStorage()->write($userInfo);
            	return true;
            }else{
            
                $auth->clearIdentity();
                return false;
            }

		}else{
			 return false;
			//$form->setDescription('Sorry. Have you activated your account? or maybe your username/password are not correct ');
       		
        }
		  
		
			
	}
	
	public function logout()
    {

		$auth = Zend_Auth::getInstance();

        // Destroy the user's authentication
        $auth->clearIdentity();
        unset ($_SESSION);

    }
}