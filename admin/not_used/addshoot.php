<?php
include '../scripts/conn.php';

$shootevent = $_POST["shootevent"];
$shoottype = $_POST["shoottype"];
$shootdate = $_POST["shootdate"];

$shootevent = mysql_real_escape_String($shootevent);
$shoottype = mysql_real_escape_String($shoottype);
$shootdate = mysql_real_escape_String($shootdate);


$sql = "INSERT INTO shoot (eventID, type, date)
VALUES
('$shootevent','$shoottype','$shootdate');";

$result = mysql_query($sql) or die(mysql_error());

header ("Location: addscoreform.php"); 
?>
