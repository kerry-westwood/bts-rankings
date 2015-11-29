<?php
include '../scripts/conn.php';

$eventmeeting = $_POST["eventmeeting"];
$eventname = $_POST["eventname"];
$eventdiscipline = $_POST["eventdiscipline"];
$gender = $_POST["gender"];
$entrants = $_POST["entrants"];



$eventmeeting = mysql_real_escape_String($eventmeeting);
$eventname = mysql_real_escape_String($eventname);
$eventdiscipline = mysql_real_escape_String($eventdiscipline);
$gender = mysql_real_escape_String($gender);
$entrants = mysql_real_escape_String($entrants);



$sql = "INSERT INTO event (meetingID, eventname, entrants, disciplineID, gender)
VALUES
('$eventmeeting','$eventname','$entrants','$eventdiscipline','$gender');";

$result = mysql_query($sql) or die(mysql_error());

header ("Location: addshootform.php"); 
?>
