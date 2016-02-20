<?php

// Fetches latest Prone ranking for Latest Ranking Page.
function prrank($prrankID = 0, $limit = 0){
	global $con;
	$prrankID = mysqli_real_escape_String($con, $prrankID);
	$limit = mysqli_real_escape_String($con, $limit);
	echo $limit;
	// Check if tprankID is set to default or if it has a non-zero value
	if ($prrankID == 0) {
		// If no rankID is provided, select latest 3P ranking ID.
		$rankindexsql = "SELECT MAX(rankindexprID) AS id FROM rankindexpr";
		$result = mysqli_query($con, $rankindexsql) or die(mysqli_error($con));
		$row = mysqli_fetch_assoc($result);
		$prindex = $row["id"];
	}
	
	// Select all competitors, ordered by rating.
	if ($limit == 0) {
	echo "Went ==";
	echo "prindex = " . $prindex;
		$pronesql = "SELECT rating, forename, surname, gender, nationality FROM ratingpr
			INNER JOIN competitor ON competitor.competitorID = ratingpr.competitorID
			INNER JOIN rankingpr ON rankingpr.ratingprID = ratingpr.ratingprID
			WHERE rankingpr.rankindexprID = $prindex
			ORDER BY rating DESC";
	}
	
	// Select limited number of competitors
	elseif ($limit !== 0) {
	echo "Went !==";
		$pronesql = "SELECT rating, forename, surname, gender, nationality FROM ratingpr
			INNER JOIN competitor ON competitor.competitorID = ratingpr.competitorID
			INNER JOIN rankingpr ON rankingpr.ratingprID = ratingpr.ratingprID
			WHERE rankingpr.rankindexprID = $prindex
			ORDER BY rating DESC
			LIMIT $limit";
	}
	
	$result = mysqli_query($con, $pronesql) or die(mysqli_error($con));
	$rankingpr = mysqli_fetch_assoc($result);
	return $rankingpr;
}



// Fetches latest 3P ranking for Latest Ranking Page.
function tprank($tprankID = 0, $limit = 0){
	global $con;
	$tprankID = mysqli_real_escape_String($con, $tprankID);
	$limit = mysqli_real_escape_String($con, $limit);
	
	// Check if tprankID is set to default or if it has a non-zero value
	if ($tprankID == 0) {
		// If no rankID is provided, select latest 3P ranking ID.
		$rankindexsql = "SELECT MAX(rankindextpID) AS id FROM rankindextp";
		$result = mysqli_query($con, $rankindexsql) or die(mysqli_error($con));
		$row = mysqli_fetch_assoc($result);
		$tpindex = $row["id"];
	}

	// Select all competitors, ordered by rating.
	if ($limit == 0) {
		$tpsql = "SELECT rating, forename, surname, gender, nationality FROM ratingtp
			INNER JOIN competitor ON competitor.competitorID = ratingtp.competitorID
			INNER JOIN rankingtp ON rankingtp.ratingtpID = ratingtp.ratingtpID
			WHERE rankingtp.rankindextpID = $tpindex
			ORDER BY rating DESC";
	}
	// Select limited number of competitors
	if ($limit !== 0) {
		$tpsql = "SELECT rating, forename, surname, gender, nationality FROM ratingtp
			INNER JOIN competitor ON competitor.competitorID = ratingtp.competitorID
			INNER JOIN rankingtp ON rankingtp.ratingtpID = ratingtp.ratingtpID
			WHERE rankingtp.rankindextpID = $tpindex
			ORDER BY rating DESC
			LIMIT $limit";
	}
		
	$rankingtp = mysqli_query($con, $tpsql) or die(mysqli_error($con));
	return $rankingtp;
}



// Fetches latest Air Pistol ranking for Latest Ranking Page.
function aprank($aprankID = 0, $limit = 0){
	global $con;
	$aprankID = mysqli_real_escape_String($con, $aprankID);
	$limit = mysqli_real_escape_String($con, $limit);

	// Check if tprankID is set to default or if it has a non-zero value
	if ($aprankID == 0) {
		// If no rankID is provided, select latest AP ranking ID.
		$rankindexsql = "SELECT MAX(rankindexapID) AS id FROM rankindexap";
		$result = mysqli_query($con, $rankindexsql) or die(mysqli_error($con));
		$id = mysqli_fetch_assoc($result);
		$apindex = $row["id"];
		}

	// Select all competitors, ordered by rating.
	if ($limit == 0) {
		$apsql = "SELECT rating, forename, surname, gender, nationality FROM ratingap
			INNER JOIN competitor ON competitor.competitorID = ratingap.competitorID
			INNER JOIN rankingap ON rankingap.ratingapID = ratingap.ratingapID
			WHERE rankingap.rankindexapID = $apindex
			ORDER BY rating DESC";
	}
	// Select limited number of competitors
	elseif ($limit !== 0) {
		$apsql = "SELECT rating, forename, surname, gender, nationality FROM ratingap
			INNER JOIN competitor ON competitor.competitorID = ratingap.competitorID
			INNER JOIN rankingap ON rankingap.ratingapID = ratingap.ratingapID
			WHERE rankingap.rankindexapID = $apindex
			ORDER BY rating DESC
			LIMIT $limit";	
	}
	
	$rankingap = mysqli_query($con, $apsql) or die(mysqli_error($con));
	return $rankingap;
}



// Fetches latest Air Rifle ranking for Latest Ranking Page.
function arrank($arrankID = 0, $limit = 0){
	global $con;
	$arrankID = mysqli_real_escape_String($con, $arrankID);
	$limit = mysqli_real_escape_String($con, $limit);

	// Check if arrankID is set to default or if it has a non-zero value
	if ($arrankID == 0) {
		// If no rankID is provided, select latest AP ranking ID.
		$rankindexsql = "SELECT MAX(rankindexarID) AS id FROM rankindexar";
		$arindex=mysqli_query($con, $rankindexsql) or die(mysqli_error($con));
		$row = mysqli_fetch_assoc($arindex);
		$arindex = $row["id"];

	}
	
	// Select all competitors, ordered by rating.
	if ($limit == 0) {
		$arsql = "SELECT rating, forename, surname, gender, nationality FROM ratingar
			INNER JOIN competitor ON competitor.competitorID = ratingar.competitorID
			INNER JOIN rankingar ON rankingar.ratingarID = ratingpr.ratingarID
			WHERE rankingar.rankindexarID = '$arindex'
			ORDER BY rating DESC";
	}
	// Select limited number of competitors
	elseif ($limit !== 0) {
		$arsql = "SELECT rating, forename, surname, gender, nationality FROM ratingar
			INNER JOIN competitor ON competitor.competitorID = ratingar.competitorID
			INNER JOIN rankingar ON rankingar.ratingarID = ratingpr.ratingarID
			WHERE rankingar.rankindexarID = '$arindex'
			ORDER BY rating DESC
			LIMIT $limit";
	}
				
	$rankingar = mysqli_query($con, $arsql) or die(mysqli_error($con));
	return $rankingar;
}
?>
