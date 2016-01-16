<?php
/* This page publishes a new ranking. It should be run after algorithm.php has been run
to update competitor ratings for all relevant shoots*/

include '../../scripts/connection.php';

/* Make New Ranking Entry and Select the rankingid for that Entry*/
$datesql = "INSERT INTO rankindexpr (date) VALUES (curdate())"; 
	if (!mysql_query($datesql,$con)) {
		die('Error: ' . mysql_error());
	} else {
	$rankid = mysql_insert_id();
	echo "Prone Ranking ID Produced " . $rankid;
	}

/* Produce List of Competitor's latest rating ordered by rating*/
$pronesql = "SELECT * 
		FROM ratingpr 
		WHERE ratingprID IN (SELECT MAX(ratingprID) FROM ratingpr GROUP BY competitorID)
		ORDER BY rating DESC";

	$proneresult = mysql_query($pronesql,$con) or die('Error: ' . mysql_error());
	
	echo "<p>Prone Ranking Produced";

/* INSERT each row into rankingpr table with rkindexprid*/
$rank = 1;

while ($row = mysql_fetch_array($proneresult)) {
	$ratingid = $row['ratingprID'];
	$ranksql = "INSERT INTO rankingpr (rankindexprID, ratingprID, rank)
	VALUES ('$rankid', '$ratingid', '$rank')";

	if (!mysql_query($ranksql,$con)) {
			die('Error: ' . mysql_error());
		}
	else {
		echo "<p>Success " . $ratingid . " - " . $rank;
	}
	$rank = $rank + 1;
	}

?>