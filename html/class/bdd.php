<?php
class bdd {

	private $host ;
	private $namebdd;
	private $bdd;
	private $pass;
	private $mybase;
	public $myco;
	public $user;
	public $userpass;


	public function __construct($host,$name,$pass,$bdd,$loginuser,$userpass){ //constructeur
		$this -> host = $host;
		$this -> bdd  = $name;
		$this -> pass = $pass;
		$this -> namebdd  = $bdd;
		$this -> user     = $loginuser;
		$this -> userpass = $userpass;
		
	}
	public function __destruct(){ //destructeur
	}
	
	public function connect_bdd(){
		Try{
		
			if($this -> mybase  = mysql_connect( $this -> host, $this -> bdd, $this -> pass )) 
			{ 
				if($this ->myco = mysql_select_db( $this -> namebdd ,$this -> mybase) )
					{	
						return true;
					}
				else  { 
					return false;
				}
			}
			else{
				return false;
			}
		}
		catch (MyException $e) {
			$TABERROR[]= $e -> getError(); 
			return false;
			}
	}
	
	public function close_bdd(){
		Try{
			mysql_close($this -> mybase);
		}
		catch (MyException $e) {
	            $TABERROR[]= $e -> getError(); 
		}
	}
	
}

?>