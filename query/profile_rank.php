<?php
// Collects latest ranking data for Competitor Profile Page 

function getRating($competitorID, $discipline) {
	// Sanitises parameters
	$competitorid = mysql_real_escape_String($competitorID);
	$discipline = mysql_real_escape_String($discipline);

	// Get ratingID for Competitor, and get Ranking/Rating if ratingID exists

	// Prone
	if($discipline == "pr") {
		$pridsql = "SELECT MAX(ratingprID) AS prid
					FROM ratingpr
					WHERE competitorID = $competitorid";
				
		$prid = mysql_query($pridsql) or die(mysql_error());
		while ($row=mysql_fetch_array($prid)) {
			$prid=$row["prid"];
		}	
		
		if($prid !== FALSE) {
			$ratesql =	"SELECT
				IFNULL((SELECT rating FROM ratingpr WHERE ratingprid = $prid),0) AS pronerate, 
				IFNULL((SELECT rank FROM rankingpr WHERE ratingprid = $prid),0) AS pronerank";
			$prrate = mysql_query($ratesql) or die(mysql_error());
			$prRate = mysql_fetch_array($prRate);
			return $prRate;
		}
	}
	
	// Three-Position
	elseif($discipline == "tp") {
		$tpidsql = "SELECT MAX(ratingtpID) AS tpid
					FROM ratingtp
					WHERE competitorID = $competitorid";
					
		$tpid = mysql_query($tpidsql) or die(mysql_error());
		while ($row=mysql_fetch_array($tpid)) {
			$tpid=$row["tpid"];
		}
		if($tpid !== FALSE) {
			$ratesql = "SELECT 
				IFNULL((SELECT rating FROM ratingtp WHERE ratingtpid = $tpid),0) AS tprate, 
				IFNULL((SELECT rank FROM rankingtp WHERE ratingtpid = $tpid),0) AS tprank";
			$tprate = mysql_query($ratesql) or die(mysql_error());
			$tpRate = mysql_fetch_array($tprate);
			return $tpRate;
		}
	}	
					
	// Air Rifle
	elseif($discipline == "ar") {
		$aridsql = "SELECT MAX(ratingarID) AS arid
					FROM ratingar
					WHERE competitorID = $competitorid";
					
		$arid = mysql_query($aridsql) or die(mysql_error());
		while ($row=mysql_fetch_array($arid)) {
			$arid=$row["arid"];
		}
		if($arid !== FALSE) {
			$ratesql = "SELECT 
				IFNULL((SELECT rating FROM ratingar WHERE ratingarid = $arid),0) AS arrate, 
				IFNULL((SELECT rank FROM rankingar WHERE ratingarid = $arid),0) AS arrank";
			$arrate = mysql_query($ratesql) or die(mysql_error());
			$arRate = mysql_fetch_array($arrate);
			return $arRate;
		}
	}
	
	// Air Pistol
	elseif($discipline == "ap") {
		$apidsql = "SELECT MAX(ratingapID) AS apid
					FROM ratingap
					WHERE competitorID = $competitorid";
					
		$apid = mysql_query($apidsql) or die(mysql_error());
		
		while ($row=mysql_fetch_array($apid)) {
			$apid=$row["apid"];
		}
		if($arid !== FALSE) {
			$ratesql = "SELECT 
				IFNULL((SELECT rating FROM ratingap WHERE ratingapid = $apid),0) AS aprate, 
				IFNULL((SELECT rank FROM rankingap WHERE ratingapid = $apid),0) AS aprank";
			$aprate = mysql_query($ratesql) or die(mysql_error());
			$apRate = mysql_fetch_array($aprate);
			return $apRate;
		}
	}	
}
/*	// Turn the array into some useful php variables
 
while ($row=mysql_fetch_array($rate)) {
			
			$pronerate=$row["pronerate"];
			$3prate=$row["3prate"];
			$arrate=$row["arrate"];
			$aprate=$row["aprate"];
			$pronerank=$row["pronerank"];
			$3prank=$row["3prank"];
			$arrank=$row["arrank"];
			$aprank=$row["aprank"]; */
?>