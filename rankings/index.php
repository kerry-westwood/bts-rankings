<?php
// Ranking Index Page

require '../scripts/connection.php';
include '../query/rank.php';
echo "Start";
// Get data
$prrank = prrank();
$tprank = tprank();
$arrank = arrank();
$aprank = aprank();
	
foreach ($prrank as $row){
		printf ("%s (%s)\n", $row["rating"], $row["surname"]);
		}

while ($row = mysqli_fetch_assoc($tprank)){
		printf ("%s (%s)\n", $row["rating"], $row["surname"]);
		}
		
while ($row = mysqli_fetch_assoc($arrank)){
		printf ("%s (%s)\n", $row["rating"], $row["surname"]);
		}

while ($row = mysqli_fetch_assoc($aprank)){
		printf ("%s (%s)\n", $row["rating"], $row["surname"]);
		}
?>