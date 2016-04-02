<?php
	include '../../scripts/connection.php';
	$meetingid = $_POST["meetingID"];
		
	// Get Events of selected meeting 
	$sql = "SELECT eventID, eventname FROM event WHERE meetingID = $meetingid";
	if (!mysqli_query($con, $sql)) {
		die('Error: ' . mysqli_error($con));
	} else {
		$result = mysqli_query($con, $sql);
	}
	$numrows = mysqli_num_rows($result);
	
	if ($numrows == 0) {
		echo "<option value=\"0\">No events found</option>";
	} else {
		echo "<option value=\"0\">Choose</option>";
		while ($row = mysqli_fetch_array($result)) {
			$eventname = $row["eventname"];
			$eventid = $row["eventID"];
			echo "<option value=\"$eventid\">".$eventname."</option>";
		}
	}

?>