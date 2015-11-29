<?php
$server = "localhost";
$user = "shotstat";
$pwd = "2ADfZm7P:76,Wy96";
$dbn = "richhemi_shotstat";

mysql_connect($server, $user, $pwd) or die(mysql_error());
mysql_select_db($dbn) or die(mysql_error());
?>
