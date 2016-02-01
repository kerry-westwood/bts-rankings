<?php
// Fetches Competitor Bio Information for the Competitor Profile Page

// Grabs competitorID & sanitises input
function getBio($competitorID) {
	global $con;
	$competitorid = mysqli_real_escape_String($con, $competitorID);

	// Selects basic bio data for athlete
	$biosql = "SELECT forename, surname, gender, birthday, nationality
				FROM competitor
				WHERE competitorID = $competitorID";
			
	$bioRes = mysqli_fetch_assoc(mysqli_query($con, $biosql));
	return $bioRes;
}

?>