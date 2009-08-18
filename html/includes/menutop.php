<?php 


?><ul>
<?php

//if not loggued
if ( !$user ){
	echo "<li><a href='index.php' target='_self' >login</a></li>";
}else{
	echo "<li class='text_shadow'>$userAuthent->username</li>";
	echo "<li class='text_shadow'><a href='display.php' target='_self' >Display results</a></li>";
	echo "<li class='text_shadow'><a href='managefiles.php' target='_self' >Manage files</a></li>";
	echo "<li class='text_shadow'><a href='refresh.php' onclick='' >Refresh</a></li>";
	echo "<li class='text_shadow'><a href='logout.php' target='_self' >logout</a></li>";
}

?>
</ul>