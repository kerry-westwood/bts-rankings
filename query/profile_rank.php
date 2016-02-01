<?php
// Collects latest ranking data for Competitor Profile Page 

function getRating($competitorID, $discipline) {
	global $con;
	// Sanitises parameters
	$competitorid = mysqli_real_escape_String($con, $competitorID);
	$discipline = mysqli_real_escape_String($con, $discipline);

	// Get ratingID for Competitor, and get Ranking/Rating if ratingID exists

	// Prone
	if($discipline == "pr") {
		$pridsql = "SELECT MAX(ratingprID) AS prid
					FROM ratingpr
					WHERE competitorID = $competitorid";
					
		// Check if the competitor has a Prone Rating		
		$row = mysqli_fetch_assoc(mysqli_query($con, $pridsql));	
		$prid = $row["prid"]; 
		
		// If rating exists, get latest rating & rank			
		if($prid !== NULL) {
			$ratesql =	"SELECT
				IFNULL((SELECT rating FROM ratingpr WHERE ratingprid = $prid),0) AS pronerate, 
				IFNULL((SELECT rank FROM rankingpr WHERE ratingprid = $prid ORDER BY rankindexprid DESC LIMIT 1),0) AS pronerank";

			$prRate = mysqli_fetch_assoc(mysqli_query($con, $ratesql));
			return $prRate;
		}
	}
	
	// Three-Position
	elseif($discipline == "tp") {
		$tpidsql = "SELECT MAX(ratingtpID) AS tpid
					FROM ratingtp
					WHERE competitorID = $competitorid";
					
		// Check if the competitor has a 3P Rating					
		$row=mysqli_fetch_assoc(mysqli_query($con, $tpidsql));
		$tpid = $row["tpid"];
		
		// If rating exists, get latest rating & rank
		if($tpid !== NULL) {
			$ratesql = "SELECT 
				IFNULL((SELECT rating FROM ratingtp WHERE ratingtpid = $tpid),0) AS tprate, 
				IFNULL((SELECT rank FROM rankingtp WHERE ratingtpid = $tpid ORDER BY rankindextpid DESC LIMIT 1),0) AS tprank";

			$tpRate = mysqli_fetch_assoc(mysqli_query($con, $ratesql));
			return $tpRate;
		}
	}	
					
	// Air Rifle
	elseif($discipline == "ar") {
		$aridsql = "SELECT MAX(ratingarID) AS arid
					FROM ratingar
					WHERE competitorID = $competitorid";
					
		// Check if the competitor has an Air Rifle Rating					
		$row=mysqli_fetch_assoc(mysqli_query($con, $aridsql));
		$arid=$row["arid"];
		
		// If rating exists, get latest rating & rank
		if($arid !== NULL) {
			$ratesql = "SELECT 
				IFNULL((SELECT rating FROM ratingar WHERE ratingarid = $arid),0) AS arrate, 
				IFNULL((SELECT rank FROM rankingar WHERE ratingarid = $arid ORDER BY rankingindexarid DESC LIMIT 1),0) AS arrank";

			$arRate = mysqli_fetch_assoc(mysqli_query($con, $ratesql));
			return $arRate;
		}
	}
	
	// Air Pistol
	elseif($discipline == "ap") {
		$apidsql = "SELECT MAX(ratingapID) AS apid
					FROM ratingap
					WHERE competitorID = $competitorid";
					
		// Check if the competitor has an Air Pistol Rating					
		$row=mysqli_fetch_array(mysqli_query($con, $apidsql));
		$apid=$row["apid"];
		
		// If rating exists, get latest rating & rank
		if($apid !== NULL) {
			$ratesql = "SELECT 
				IFNULL((SELECT rating FROM ratingap WHERE ratingapid = $apid),0) AS aprate, 
				IFNULL((SELECT rank FROM rankingap WHERE ratingapid = $apid ORDER BY rankingindexapid DESC LIMIT 1),0) AS aprank";

			$apRate = mysqli_fetch_assoc(mysqli_query($con, $ratesql));
			return $apRate;
		}
	}	
}
/*	// Turn the array into some useful php variables
 
while ($row=mysqli_fetch_array($rate)) {
			
			$pronerate=$row["pronerate"];
			$3prate=$row["3prate"];
			$arrate=$row["arrate"];
			$aprate=$row["aprate"];
			$pronerank=$row["pronerank"];
			$3prank=$row["3prank"];
			$arrank=$row["arrank"];
			$aprank=$row["aprank"]; */
?>