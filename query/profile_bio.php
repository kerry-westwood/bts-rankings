<?php
// Fetches Competitor Bio Information for the Competitor Profile Page

// Grabs competitorID & sanitises input
function getBio($competitorID) {
	$competitorid = mysql_real_escape_String($competitorID);

	// Selects basic bio data for athlete
	$biosql = "SELECT forename, surname, gender, birthday, nationality
				FROM competitor
				WHERE competitorID = $competitorID";
			
	$bio = mysql_query($biosql) or die(mysql_error());
	$bioRes = mysql_fetch_array($bio);
	return $bioRes;
}

?>