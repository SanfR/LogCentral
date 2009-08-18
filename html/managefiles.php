<?php
include('includes/config.php');
include('autoload.php');

$authentClass = new Authentification();

//check if the user is loggued
$userAuthent = $authentClass->isLoggedIn();

//if not loggued
if ( !$userAuthent ){
	header( 'Location: /index.php');
} 

$connection = new Database($base, $server, $user, $pass);
$logClass = new Logs($logserror);
$fileLogs = new FileLogs($userAuthent->id,$connection,$logClass);

try{
	//adding
	if (isset($_POST['filename']) && !empty($_POST['filename'])){
		if (empty($_POST['delimiter'])){
			throw new Exception ('Delimiter is empty.');
		}else{
			$fileLogs->setFilelog($_POST['delimiter'],$_POST['filename']);
		}
	}
	
	//deleting
	if (isset($_POST['todelete']) && !empty($_POST['todelete'])){
		
		foreach($_POST['todelete'] as $key => $values){
			$fileLogs->deleteFilelog($values);
		}
	}

	$fileLogs->getFilelog();
	$resultarray = $fileLogs->arrayFile;
}catch(Exception $e){
	echo $e->getMessage();
}
?>

<html>
<head><title><?php echo $titleSite;?></title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="style/style.css"       rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function empty(field){
		document.getElementById(field).value = '';
	}
</script>
</head>
<body>
<div id="menu">
<?php include('includes/menutop.php');?>
</div>
<div id="headdiv"><h1><?php echo $titleSite;?></h1></div>
<div class="clear" ></div>
<div id="addnewfilediv">
	<form name='addnewfile' id='addnewfile' action='managefiles.php' method='POST' >
	<label for="filename">Add new file</label>
	
	<input type='text' id='delimiter' name='delimiter' value='delimiter' onclick="javascript:empty('delimiter');" />
	<input type='text' id='filename' name='filename' value='filename'  onclick="javascript:empty('filename');"  />
	<input type='submit' id='add' name='add' value='Add' />
	</form>
</div>
<div class="clear" ></div>
<div id='resultarray'>
<form name='removefile' id='removefile' action='managefiles.php' method='POST' >
	<table width="100%">
		<tr>
			<td>delete</td>
			<td>Id</td>
			<td>FileName</td>
			<td>Delimiter</td>
			<td>Usid</td>
		</tr>
		
		<?php 
		
		if (count($resultarray) >0){
			foreach($resultarray as $key => $values){
				
				echo "<tr><td><input type='checkbox' name='todelete[]' id='todelete' value='".$values->id."'/></td>";
				foreach($values as $keyVal => $valVal){
					echo "<td>$valVal</td>";
				}
				echo "</tr>";
			}
		}
		?>
	
	
	</table>
	
	<input type='submit' id='delete' name='delete' value='Delete' />
</form>
</div>
<div id="message"> <?php echo $message;?></div>

</body>
</html>