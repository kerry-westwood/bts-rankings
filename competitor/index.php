<?php
require '../scripts/connection.php';
include '../query/profile_bio.php';
include '../query/profile_rank.php';
include '../query/profile_results.php';

// Get the CompetitorID
$getID = 0;
if(isset($_GET["competitor"])) {
	$getID = $_GET["competitor"];
}

// Check CompetitorID has been changed from zero and load Bio data
if($getID !== 0) {

	// parameters: competitorID
	$competitorBio = getBio($getID);

	if($competitorBio !== FALSE) {
		var_dump($competitorBio);
		//echo $competitorBio["forename"];
	}
	else {
		echo "Sorry, No competitor found.";		
	}
	
	// Fetch Ratings and Results only if CompetitorBio !==FALSE
	// Ratings & Ranks
	if($competitorBio !== FALSE) {
		$ratings = getRating($getID, "pr");
		var_dump($ratings);
	}

	if($competitorBio !== FALSE) {
		$ratings = getRating($getID, "tp");
		var_dump($ratings);
	}

	if($competitorBio !== FALSE) {
		$ratings = getRating($getID, "ar");
		var_dump($ratings);
	}
	
	if($competitorBio !== FALSE) {
		$ratings = getRating($getID, "ap");
		var_dump($ratings);
	}

	// Results
	if($competitorBio !== FALSE) {	
		$resultsPR = getPR($getID);
		var_dump($resultsPR);
	}
	
	if($competitorBio !== FALSE) {
		$resultsTP = getTP($getID);
		var_dump($resultsTP);
	}

	if($competitorBio !== FALSE) {
		$resultsAR = getAR($getID);
		var_dump($resultsAR);
	}
	if($competitorBio !== FALSE) {
		$resultsAP = getAP($getID);	
		var_dump($resultsAP);
	}
	
} else {
	echo "Sorry, No competitor found.";
}


?>