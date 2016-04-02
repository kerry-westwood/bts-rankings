<?php
	//DB connection
	include 'conn.php';
    $year = $_POST["year"];
	$sel_champ = $_POST["sel_champ"];
	$year = mysql_real_escape_String($year);
	$sel_champ = mysql_real_escape_String($sel_champ);
	
	$champs_sql="SELECT `eventID`, `name` FROM `event` WHERE `year` = $year";
	$champs_result=mysql_query($champs_sql);

	while ($row=mysql_fetch_array($champs_result)) {
		$champ_id=$row["eventID"];
		$champ_name=$row["name"];
		
		if($sel_champ != "test") {
			if($champ_name == $sel_champ) {
				echo "<input type=\"radio\" value=\"$champ_id\" name=\"champ\" checked=\"checked\" /><label>$champ_name</label>";
			}
		}
		else {
			echo "<input type=\"radio\" value=\"$champ_id\" name=\"champ\" /><label>$champ_name</label>";
		}
	}
	
?>