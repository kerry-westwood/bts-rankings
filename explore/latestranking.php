<?php
//This page accepts no variables or inputs. It simply outputs the latest list of rankings & ratings.
include '../scripts/conn.php';

/* Get latest (largest) rankingindexprID*/
$ranksql = "SELECT MAX(rankindexprID) FROM rankindexpr";
if (!mysql_query($ranksql)) {
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

//Compile ranking list based on latest $rankID - Select competitor name & rating based on $rankid, order by rankingID.
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
	//Echo out list of competitors from array
	while ($row1 = mysql_fetch_array($rankingresult)) {
		$competitor = $row1["forename"];
		$competitors = $row1["surname"];
		$rating = $row1["rating"];
		$rank = $row1["rankingID"];
		echo "<p>" . $competitor . " " . $competitors . " is rated " . $rating . ". RankID = " . $rank ."</p>";
		}

?>

