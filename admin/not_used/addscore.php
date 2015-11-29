<?php
include '../scripts/conn.php';

$shoot = $_POST["shoot"];
$competitor = $_POST["competitor"];
$q1 = $_POST["q1"];
$q2 = $_POST["q2"];
$q3 = $_POST["q3"];
$q4 = $_POST["q4"];
$q5 = $_POST["q5"];
$q6 = $_POST["q6"];
$qtotal = $_POST["qtotal"];
$f1 = $_POST["f1"];
$f2 = $_POST["f2"];
$f3 = $_POST["f3"];
$f4 = $_POST["f4"];
$f5 = $_POST["f5"];
$f6 = $_POST["f6"];
$f7 = $_POST["f7"];
$f8 = $_POST["f8"];
$f9 = $_POST["f9"];
$f10 = $_POST["f10"];
$f11 = $_POST["f11"];
$f12 = $_POST["f12"];
$f13 = $_POST["f13"];
$f14 = $_POST["f14"];
$f15 = $_POST["f15"];
$f16 = $_POST["f16"];
$f17 = $_POST["f17"];
$f18 = $_POST["f18"];
$f19 = $_POST["f19"];
$f20 = $_POST["f20"];
$final = $_POST["final"];
$penalties = $_POST["penalties"];
$notes = $_POST["notes"];
$position = $_POST["position"];


$shoot = mysql_real_escape_String($shoot);
$competitor = mysql_real_escape_String($competitor);
$q1 = mysql_real_escape_String($q1);
$q2 = mysql_real_escape_String($q2);
$q3 = mysql_real_escape_String($q3);
$q4 = mysql_real_escape_String($q4);
$q5 = mysql_real_escape_String($q5);
$q6 = mysql_real_escape_String($q6);
$qtotal = mysql_real_escape_String($qtotal);
$f1 = mysql_real_escape_String($f1);
$f2 = mysql_real_escape_String($f2);
$f3 = mysql_real_escape_String($f3);
$f4 = mysql_real_escape_String($f4);
$f5 = mysql_real_escape_String($f5);
$f6 = mysql_real_escape_String($f6);
$f7 = mysql_real_escape_String($f7);
$f8 = mysql_real_escape_String($f8);
$f9 = mysql_real_escape_String($f9);
$f10 = mysql_real_escape_String($f10);
$f11 = mysql_real_escape_String($f11);
$f12 = mysql_real_escape_String($f12);
$f13 = mysql_real_escape_String($f13);
$f14 = mysql_real_escape_String($f14);
$f15 = mysql_real_escape_String($f15);
$f16 = mysql_real_escape_String($f16);
$f17 = mysql_real_escape_String($f17);
$f18 = mysql_real_escape_String($f18);
$f19 = mysql_real_escape_String($f19);
$f20 = mysql_real_escape_String($f20);
$final = mysql_real_escape_String($final);
$penalties = mysql_real_escape_String($penalties);
$notes = mysql_real_escape_String($notes);
$position = mysql_real_escape_String($position);

$sql = "INSERT INTO scorepr VALUES ('','$shoot','$competitor','$q1','$q2','$q3','$q4','$q5','$q6','$penalties','$qtotal','$f1','$f2','$f3','$f4','$f5','$f6','$f7','$f8','$f9','$f10','$f11','$f12','$f13','$f14','$f15','$f16','$f17','$f18','$f19','$f20','$final','$notes','$position');";

$result = mysql_query($sql) or die(mysql_error());

header ("Location: addscoreform.php"); 
?>
