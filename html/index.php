<?php
include('includes/config.php');
include('autoload.php');
$message = '';

//init just if its posted
if (isset($_POST) ){
	$common = new Common();
	$logError   = new Logs($logserror);
	$connection = new Database($base, $server, $user, $pass);	
	$userClass  = new Users($connection);
	$authent    = new Authentification();
}

//if its posted then login
if (isset($_POST['username']) && !empty($_POST['username'])){
	$resIdent = $authent->isUser($_POST, $connection);
	if ($resIdent == true){
		header("location:/display.php");
	}else{
		$message = "Your are not a user";
	}
}
 
//if its posted then save new user
if ($_POST['susername'] && !empty($_POST['susername'])){
 
	//check if the user exists
	$checkUser  = $userClass->checkIfUserExists($common->protectSQL($_POST['susername']));
	if($checkUser == false){
		$resInsert  = $userClass->setUser( $common->protectSQL($_POST['susername']));
		  
		$fileLogs = new Filelogs($resInsert,$connection, $logError);
		$resInsertFile = $fileLogs->setFilelog($common->protectSQL($_POST['sdelimiter']),
		$common->protectSQL($_POST['spath']));
		
		if ($resInsertFile == true){ 
			$message = "You have been added. Please log.";
		}else{ 
			$message = "Error Please try again.".$resInsert.$resInsertFile;
		}
	}else{ 
		$message = "This name is already taken.";
	}
	
	
}
?>
<html>
<head><title><?php echo $titleSite;?></title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="style/style.css"       rel="stylesheet" type="text/css" />
</head>
<body>
<div id="headdiv"><h1><?php echo $titleSite;?></h1></div>

<div id="main"><h2>Log in</h2>
	<form id="formlogin" name="formlogin" action="index.php" method="post" >
		<ul><li><label for="username">Username:</label><li></li><input type="text" id="username" name="username" value="" /></li>
		<li><input type="submit" id="button" name="button" value="Login" /></li></ul>
	</form>
</div>	
<div id="message"> <?php echo $message;?></div>
<div id="main">
<h2>Sign up</h2>
	<form id="formSign" name="formSign" action="index.php" method="post" >
	<ul>
		<li><label for ="susername"> Username:</label>
		<li></li><input type="text" id="susername" name="susername" value="" />
		</li>
		<li><label for ="sdelimiter"> Delimiter:</label>
		<li></li><input type="text" id="sdelimiter" name="sdelimiter" value="" />
		</li>
		<li><label for ="spath"> Path:</label>
		<li></li><input type="text" id="spath" name="spath" value="" />
		</li>
		<li><input type="submit" id="button" name="button" value="Signup" /></li>
	</ul>
	</form>
</div>
</body>
</html>