<?php
	include '../../scripts/connection.php';
	$meetingid = $_POST["meetingID"];
	// Get Events of selected meeting 
	$sql = "SELECT eventID, eventname FROM event WHERE meetingID = $meetingid";
	if (!mysql_query($sql,$con)) {
		die('Error: ' . mysql_error());
	} else {
		$result = mysql_query($sql);
	}
	$numrows = mysql_num_rows($result);
	
	if ($numrows == 0) {
		echo "<option value=\"0\">No events found</option>";
	} else {
		echo "<option value=\"0\">Choose</option>";
		while ($row = mysql_fetch_array($result)) {
			$eventname = $row["eventname"];
			$eventid = $row["eventID"];
			echo "<option value=\"$eventid\">".$eventname."</option>";
		}
	}

?>