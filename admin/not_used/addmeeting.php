<?php
include '../scripts/conn.php';

$meetingname = $_POST["meetingname"];
$meetingyear = $_POST["meetingyear"];

$meetingname = mysql_real_escape_String($meetingname);
$meetingyear = mysql_real_escape_String($meetingyear);

$sql = "INSERT INTO meeting (meetingname, year)
VALUES
('$meetingname','$meetingyear');";

$result = mysql_query($sql) or die(mysql_error());

header ("Location: addeventform.php"); 
?>
