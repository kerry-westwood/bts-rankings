<?php
	$server = "localhost";
	$user = "shotstat";
	$pwd = "2ADfZm7P:76,Wy96";
	$dbn = "richhemi_shotstat";
	
	$con = mysql_connect($server, $user, $pwd);
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
		
	mysql_select_db($dbn, $con) or die(mysql_error());
?>