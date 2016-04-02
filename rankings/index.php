<?php

// Ranking Index Page
require '../scripts/connection.php';
include '../query/rank.php';

// Get data
$prrank = prrank();
foreach ($prrank as $row){
		printf ("%s (%s)\n", $row["rating"], $row["surname"]);
		}
$tprank = tprank();
foreach ($tprank as $row){
		printf ("%s (%s)\n", $row["rating"], $row["surname"]);
		}
$arrank = arrank();		
foreach ($arrank as $row){
		printf ("%s (%s)\n", $row["rating"], $row["surname"]);
		}
$aprank = aprank();
foreach ($aprank as $row){
		printf ("%s (%s)\n", $row["rating"], $row["surname"]);
		}
		
?>