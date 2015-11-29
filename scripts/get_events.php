<?php
	include 'conn.php';
    $champ = $_POST["champ"];
	$champ = mysql_real_escape_String($champ);
	$sel_event = $_POST["sel_event"];
	$sel_event = mysql_real_escape_String($sel_event);
	
	$event_sql="SELECT `groupID`, `name` FROM `group` WHERE `eventID` = $champ";
	$event_result=mysql_query($event_sql);

	while ($row=mysql_fetch_array($event_result)) {
		$event_id=$row["groupID"];
		$event_name=$row["name"];
		
		if($sel_event != "test") {
			if($event_name == $sel_event) {
				echo "<input type=\"radio\" value=\"$event_id\" name=\"event\" checked=\"checked\" /><label>$event_name</label>";
			}
		}
		else {
			echo "<input type=\"radio\" value=\"$event_id\" name=\"event\" /><label>$event_name</label>";
		}
		
	}
	
?>