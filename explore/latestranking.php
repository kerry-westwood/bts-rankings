<?php

include '../scripts/connection.php';

/* Get latest rankingindexprID*/
$ranksql = "SELECT MAX(rankindexprID) FROM rankindexpr";
if (!mysql_query($ranksql,$con)) {
			die('Error: ' . mysql_error());
	} else {
	$rankresult = mysql_query($ranksql);
	}
	
	$rankid = 0;
	//$row = mysql_fetch_array($rankresult);
	while ($row = mysql_fetch_array($rankresult)) {
		$rankid = $row["MAX(rankindexprID)"];
		//print_r ($row["MAX(rankindexprID)"]);
	}
	
//print_r($row);
//echo "Boom " . $rankid;

	
$rankingsql =	"SELECT competitor.forename, competitor.surname, competitor.competitorID, ratingpr.rating, rankingpr.rankingID
				FROM competitor
				INNER JOIN ratingpr ON competitor.competitorid = ratingpr.competitorID
				INNER JOIN rankingpr ON ratingpr.ratingprID = rankingpr.ratingprID
				WHERE rankingpr.rankindexprID = $rankid
				ORDER BY rankingpr.rankingID;";

	if (!mysql_query($rankingsql,$con)) {
			die('Error: ' . mysql_error());
	} else {
	$rankingresult = mysql_query($rankingsql);
	}
	while ($row1 = mysql_fetch_array($rankingresult)) {
		$competitor = $row1["forename"];
		$competitors = $row1["surname"];
		$rating = $row1["rating"];
		$rank = $row1["rankingID"];
		echo "<p>" . $competitor . " " . $competitors . " is rated " . $rating . ". RankID = " . $rank ."</p>";
		}

?>

