<?php
	include 'conn.php';
    
	$event = $_POST["event"];
	$event = mysql_real_escape_String($event);

	$sql="SELECT shootID, name FROM shoot WHERE groupID = $event";

	$event_res = mysql_query($sql) or die(mysql_error());
	
	while ($row=mysql_fetch_array($event_res)) {

		$shootid=$row["shootID"];
		$name=$row["name"];
		echo "<h3>$name</h3>";
		
		$sql2 = "SELECT scoreprone.shootID, scoreprone.p1, scoreprone.p2, scoreprone.p3, scoreprone.p4, "
				."scoreprone.p5, scoreprone.p6, scoreprone.total, scoreprone.penalties, scoreprone.rank, "
				."scoreprone.notes, scoreprone.target, competitor.forename, competitor.surname, competitor.nationality "
				."FROM scoreprone INNER JOIN competitor ON scoreprone.compID=competitor.compID WHERE scoreprone.shootID = $shootid ORDER BY scoreprone.rank";
		$comp_res = mysql_query($sql2) or die(mysql_error());
		
		echo "<table><tr><th>Rank</th><th>Name</th><th>Nationality</th><th>p1</th><th>p2</th><th>p3</th><th>p4</th><th>p5</th><th>p6</th>".
				"<th>Total</th><th>Penalties</th><th>notes</th><th>target</th></tr>";
		while ($row2=mysql_fetch_array($comp_res)) {
			$p1=$row2["p1"];
			$p2=$row2["p2"];
			$p3=$row2["p3"];
			$p4=$row2["p4"];
			$p5=$row2["p5"];
			$p6=$row2["p6"];
			$total=$row2["total"];
			$pen=$row2["penalties"];
			$rank=$row2["rank"];
			$notes=$row2["notes"];
			$target=$row2["target"];
			$forename=$row2["forename"];
			$surname=$row2["surname"];
			$nation=$row2["nationality"];
			echo "<tr><td>$rank</td><td>$forename $surname</td><td>$nation</td><td>$p1</td><td>$p2</td><td>$p3</td><td>$p4</td>".
				"<td>$p5</td><td>$p6</td><td>$total</td>$pen</td><td>$notes</td><td>$target</td></tr>";
		}	
		echo "</table>";
	}
		
?>
	