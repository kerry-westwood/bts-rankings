<?php

// Fetches latest Prone ranking for Latest Ranking Page.
function prrank($prrankID = 0, $limit = 0){
	global $con;
	$prindex = mysqli_real_escape_String($con, $prrankID);
	$limit = mysqli_real_escape_String($con, $limit);

	// Check if tprankID is set to default or if it has a non-zero value
	if ($prindex == 0) {
		// If no rankID is provided, select latest Prone ranking ID.
		$rankindexsql = "SELECT MAX(rankindexprID) AS id FROM rankindexpr";
		$result = mysqli_query($con, $rankindexsql) or die(mysqli_error($con));
		$row = mysqli_fetch_assoc($result);
		$prindex = $row["id"];
	}

	// Check there's a number there and we're not going to feed 'null' into the SQL
	if (is_numeric($prindex)) { 
		// Select all competitors, ordered by rating.
		if ($limit == 0) {
		echo "Prone Went ==";
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
		return $result;
	}

	else {
		return null;
	}
}



// Fetches latest 3P ranking for Latest Ranking Page.
function tprank($tprankID = 0, $limit = 0){
	global $con;
	$tpindex = mysqli_real_escape_String($con, $tprankID);
	$limit = mysqli_real_escape_String($con, $limit);
	echo $limit;
	// Check if tprankID is set to default or if it has a non-zero value
	if ($tpindex == 0) {
		// If no rankID is provided, select latest 3P ranking ID.
		$rankindexsql = "SELECT MAX(rankindextpID) AS id FROM rankindextp";
		$result = mysqli_query($con, $rankindexsql) or die(mysqli_error($con));
		$row = mysqli_fetch_assoc($result);
		$tpindex = $row["id"];
	}

	// Check there's a number there and we're not going to feed 'null' into the SQL
	if (is_numeric($tpindex)) {
		// Select all competitors, ordered by rating.
		if ($limit == 0) {
		echo "TP Went == " . $limit;
		$tpsql = "SELECT rating, forename, surname, gender, nationality FROM ratingtp
			INNER JOIN competitor ON competitor.competitorID = ratingtp.competitorID
			INNER JOIN rankingtp ON rankingtp.ratingtpID = ratingtp.ratingtpID
			WHERE rankingtp.rankindextpID = $tpindex
			ORDER BY rating DESC";
		}
		// Select limited number of competitors
		elseif ($limit !== 0) {
			echo "TP Went !==";
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
	
	else {
		return null;
	}
}



// Fetches latest Air Pistol ranking for Latest Ranking Page.
function aprank($aprankID = 0, $limit = 0){
	global $con;
	$apindex = mysqli_real_escape_String($con, $aprankID);
	$limit = mysqli_real_escape_String($con, $limit);

	// Check if tprankID is set to default or if it has a non-zero value
	if ($apindex == 0) {
		// If no rankID is provided, select latest AP ranking ID.
		$rankindexsql = "SELECT MAX(rankindexapID) AS id FROM rankindexap";
		$result = mysqli_query($con, $rankindexsql) or die(mysqli_error($con));
		$row = mysqli_fetch_assoc($result);
		$apindex = $row["id"];
	}

	// Check there's a number there and we're not going to feed 'null' into the SQL
	if (is_numeric($apindex)) {
		// Select all competitors, ordered by rating.
		if ($limit == 0) {
		echo "AP Went ==";
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
	
	else {
		return null;
	}
}



// Fetches latest Air Rifle ranking for Latest Ranking Page.
function arrank($arrankID = 0, $limit = 0){
	global $con;
	$arindex = mysqli_real_escape_String($con, $arrankID);
	$limit = mysqli_real_escape_String($con, $limit);

	// Check if arrankID is set to default or if it has a non-zero value
	if ($arindex == 0) {
		// If no rankID is provided, select latest AP ranking ID.
		$rankindexsql = "SELECT MAX(rankindexarID) AS id FROM rankindexar";
		$arindex=mysqli_query($con, $rankindexsql) or die(mysqli_error($con));
		$row = mysqli_fetch_assoc($arindex);
		$arindex = $row["id"];
	}

	// Check there's a number there and we're not going to feed 'null' into the SQL
	if (is_numeric($arindex)) {	
		// Select all competitors, ordered by rating.
		if ($limit == 0) {
		echo "AR Went ==";
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
	
	else {
		return null;
	}
}

?>
