<?php
include 'conn.php';

	$eventid = $_POST["eventID"];
	
	$count="SELECT eventID, COUNT(*) FROM score WHERE eventID = "$eventid";
	
	$results="SELECT scoreID, athleteID, rank FROM score WHERE eventID = $eventid";

	$event_res = mysql_query($results) or die(mysql_error());
	
		while ($row=mysql_fetch_array($event_res)) {

			$athleteid=$row["athleteID"];
			$rank=$row["rank"];
			echo "<p>$athleteid, $rank</p>";
		}
		
		?>
	