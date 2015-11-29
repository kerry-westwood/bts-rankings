<?php
include '../scripts/conn.php';

$event = $_POST["shootevent"];
$event = mysql_real_escape_String($event);

$sql="SELECT shootID, name, courseID FROM shoot WHERE eventID = $event";

$result = mysql_query($sql) or die(mysql_error());

while ($row=mysql_fetch_array($result)) {

    $shootid=$row["shootID"];
    $name=$row["name"];
    $courseid=$row["courseID"];
	echo "<p>$shootid, $name, $courseid</p>";
}


?>
