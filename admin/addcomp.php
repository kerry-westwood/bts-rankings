<?php
include '../scripts/conn.php';

$compfore = $_POST["compfore"];
$compsur = $_POST["compsur"];
$gender = $_POST["gender"];
$birthday = $_POST["birthday"];
$nationality = $_POST["nationality"];

$compfore = mysql_real_escape_String($compfore);
$compsur = mysql_real_escape_String($compsur);
$gender = mysql_real_escape_String($gender);
$birthday = mysql_real_escape_String($birthday);
$nationality = mysql_real_escape_String($nationality);

$sql = "INSERT INTO competitor (forename, surname, gender, birthday, nationality)
VALUES
('$compfore','$compsur','$gender','$birthday','$nationality');";

$result = mysql_query($sql) or die(mysql_error());

header ("Location: addcompform.html"); 
?>
