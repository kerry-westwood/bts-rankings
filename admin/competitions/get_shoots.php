<?php
	include '../../scripts/connection.php';
	$eventid = $_POST["eventID"];
	// Get shoots of selected event 
	$sql = "SELECT shootID, type FROM shoot WHERE eventID = $eventid";
	if (!mysqli_query($con, $sql)) {
		die('Error: ' . mysqli_error($con));
	} else {
		$result = mysqli_query($con, $sql);
	}
	$numrows = mysqli_num_rows($result);
	
	if ($numrows == 0) {
		echo "<option value=\"0\">No shoots found</option>";
	} else {
		echo "<option value=\"0\">Choose</option>";
		while ($row = mysqli_fetch_array($result)) {
			$shootid = $row["shootID"];
			$shoottype = $row["type"];
			$shoottypename = "";
			switch ($shoottype) {
				case 1 :
					$shoottypename = "Elimination 1";
				break;
				case 2 :
					$shoottypename = "Elimination 2";
				break;
				case 3 :
					$shoottypename = "Elimination 3";
				break;
				case 4 :
					$shoottypename = "Elimination 4";
				break;
				case 5 :
					$shoottypename = "Elimination 5";
				break;
				case 6 :
					$shoottypename = "Qualification &amp; Final";
				break;
				case 7 :
					$shoottypename = "Badges";
				break;
			}
			echo "<option value=\"$shootid\">".$shoottypename."</option>";
		}
	}
?>