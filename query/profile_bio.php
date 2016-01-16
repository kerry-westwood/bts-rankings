<?php
// Fetches Competitor Bio Information for the Competitor Profile Page

include '../scripts/conn.php';

// Grabs competitorID & sanitises input
$competitorid = $_GET["profile"];
$competitorid = mysql_real_escape_String($competitorid);

// Selects basic bio data for athlete
$biosql = "SELECT forename, surname, gender, birthday, nationality
			FROM competitor
			WHERE competitorID = "$competitorid"";
			
$bio=mysql_query($biosql) or die(mysql_error());

// Turn the array into some useful php variables
 
while ($row=mysql_fetch_array($comp_res)) {
			
			$forename=$row["forename"];
			$surname=$row["surname"];
			$gender=$row["gender"];
			$birthday=$row["birthday"];
			$nationality=$row["nationality"];
}

?>