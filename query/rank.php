<?php
// include '../scripts/conn.php';

// Fetches latest Prone ranking for Latest Ranking Page.
function prrank($prrankID = 0){
	$prrankID = mysqli_real_escape_String($prrankID);
	
	// Check if tprankID is set to default or if it has a non-zero value
	if ($prrankID == 0) {
		// If no rankID is provided, select latest 3P ranking ID.
		$rankindexsql = "SELECT MAX(rankindexprID) FROM rankindexpr";
		$prindex=mysqli_query($prindexsql) or die(mysqli_error());
	}
	
	// Select all competitors, ordered by rating.
	
	$pronesql = "SELECT rating, forename, surname, gender, nationality FROM ratingpr
			INNER JOIN competitor ON competitor.competitorID = ratingpr.competitorID
			INNER JOIN rankingpr ON rankingpr.ratingprID = ratingpr.ratingprID
			WHERE rankingpr.rankindexprID = '$prindex'
			ORDER BY rating DESC;"
			
	$prresults = mysqli_query($pronesql) or die(mysqli_error());
	$rankingpr = mysqli_fetch_array($prresults);
	return $rankingpr;
}



// Fetches latest 3P ranking for Latest Ranking Page.
function tprank($tprankID = 0){
	$tprankID = mysqli_real_escape_String($tprankID);
	
	// Check if tprankID is set to default or if it has a non-zero value
	if ($tprankID == 0) {
		// If no rankID is provided, select latest 3P ranking ID.
		$rankindexsql = "SELECT MAX(rankindex3pID) FROM rankindex3p";
		$tpindex=mysqli_query($rankindexsql) or die(mysqli_error());
	}

	// Select all competitors, ordered by rating.

	$tpsql = "SELECT rating, forename, surname, gender, nationality FROM ratingtp
			INNER JOIN competitor ON competitor.competitorID = ratingtp.competitorID
			INNER JOIN rankingtp ON rankingtp.ratingtpID = ratingtp.ratingtpID
			WHERE rankingtp.rankindextpID = '$tpindex'
			ORDER BY rating DESC;"
			
	$tpresults = mysqli_query($tpsql) or die(mysqli_error());
	$rankingtp = mysqli_fetch_array($tpresults);
	return $rankingtp;
}



// Fetches latest Air Pistol ranking for Latest Ranking Page.
function aprank($aprankID = 0){
	$aprankID = mysqli_real_escape_String($aprankID);

	// Check if tprankID is set to default or if it has a non-zero value
	if ($aprankID == 0) {
		// If no rankID is provided, select latest AP ranking ID.
		$rankindexsql = "SELECT MAX(rankindexapID) FROM rankindexap";
		$apindex=mysqli_query($rankindexsql) or die(mysqli_error());
		}

	// Select all competitors, ordered by rating.
	$apsql = "SELECT rating, forename, surname, gender, nationality FROM ratingap
			INNER JOIN competitor ON competitor.competitorID = ratingap.competitorID
			INNER JOIN rankingap ON rankingap.ratingapID = ratingap.ratingapID
			WHERE rankingap.rankindexapID = '$apindex'
			ORDER BY rating DESC;"
			
	$apresults = mysqli_query($apsql) or die(mysqli_error());
	$rankingap = mysqli_fetch_array($apresults);
	return $rankingap;
}



// Fetches latest Air Rifle ranking for Latest Ranking Page.
function aprank($arrankID = 0){
	$arrankID = mysqli_real_escape_String($arrankID);

	// Check if arrankID is set to default or if it has a non-zero value
	if ($arrankID == 0) {
		// If no rankID is provided, select latest AP ranking ID.
		$rankindexsql = "SELECT MAX(rankindexarID) FROM rankindexar";
		$arindex=mysqli_query($rankindexsql) or die(mysqli_error());
	}
	
	// Select all competitors, ordered by rating.
	$arsql = "SELECT rating, forename, surname, gender, nationality FROM ratingar
			INNER JOIN competitor ON competitor.competitorID = ratingar.competitorID
			INNER JOIN rankingar ON rankingar.ratingarID = ratingpr.ratingarID
			WHERE rankingar.rankindexarID = '$arindex'
			ORDER BY rating DESC;"
				
	$arresults = mysqli_query($arsql) or die(mysqli_error());
	$rankingar = mysqli_fetch_array($arresults);
	return $rankingar;
}
?>
