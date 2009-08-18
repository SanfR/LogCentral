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

$fileLogs->getFilelog();
$resultarray = $fileLogs->arrayFile;
?>

<html>
<head><title><?php echo $titleSite;?></title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="style/style.css"       rel="stylesheet" type="text/css" />
</head>
<body>
<div id="menu">
<?php include('includes/menutop.php');?>
</div>
<div id="headdiv"><h1>Refresh</h1></div>

<div id='resultarray'>
<table width="100%">
		<tr>
			<td>Id</td>
			<td>FileName</td>
			<td>Delimiter</td>
			<td>usid</td>
		</tr>
		
	<?php 
		
		if (count($resultarray) >0){
			foreach($resultarray as $key => $values){
				//do the sql load ...
				//$values->file_name
				
				echo "<tr>";
					echo "<td>$values->id</td>";
					echo "<td>$values->file_name</td>";
					echo "<td>$values->delimiter</td>";
					echo "<td>$values->us_id</td>";
			
				echo "</tr>";
			}
		}
		?>
		
	</table>
</div>
<div id="message"> <?php echo $message;?></div>
<div id="main">

</div>
</body>
</html>