<?php
//Fetches list of shoots at an event
include '../scripts/conn.php';

	//POST in $event value & sanitise
    $event = $_POST["shootevent"];
	$event = mysqli_real_escape_String($event);

	$sql="SELECT shootID, name, courseID FROM shoot WHERE eventID = $event";

	$event_res = mysqli_query($con, $sql) or die(mysqli_error());
	
		while ($row=mysqli_fetch_array($event_res)) {

			$shootid=$row["shootID"];
			$name=$row["name"];
			$courseid=$row["courseID"];
			echo "<p>$shootid, $name, $courseid</p>";
		}
		
		?>
	