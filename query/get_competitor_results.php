<?php
	// DB connection
	include '../scripts/connection.php';
	
    $competitor = $_POST["competitor"];
	$competitor = mysql_real_escape_String($competitor);

	// Get Competitor Details
	$compsql="SELECT surname, forename, nationality FROM competitor ORDER BY surname WHERE competitorID=$competitor";
	$compresult=mysql_query($compsql);

	while ($row=mysql_fetch_array($compresult)) {

    echo $row["forename"] . " " . $row["surname"];
    echo "<p> Nationality: " . $row["nationality"];
    	}

	//Get Competitor Results
	$resultsql="SELECT scorepr.competitorID AS 'competitor', scorepr.position AS 'position', scorepr.shootID AS 'shootid', scorepr.1 AS '1', scorepr.2 AS '2', scorepr.3 AS '3', scorepr.4 AS '4', scorepr.5 AS '5', scorepr.6 AS '6', scorepr.total AS 'Total', (
				SELECT ratingpr.rating
				FROM ratingpr
				WHERE scorepr.scoreprID = ratingpr.scoreprID
				) AS rating
				FROM scorepr
				INNER JOIN shoot ON scorepr.shootID = shoot.shootID
				WHERE scorepr.competitorID =2
				ORDER BY score.scorepr DESC";


/*	$comp_res = mysql_query($resultsql) or die(mysql_error());
	
		while ($row=mysql_fetch_array($comp_res)) {
			
			$shootid=$row["shootid"];
			$shootname=$row["Name"];
			$total=$row["Total"];
			$rank=$row["Rank"];
			
			$grpsql="SELECT group.groupID AS 'groupid', group.name AS 'group'
			FROM shoot
			INNER JOIN group
			ON shoot.groupID = group.groupID
			WHERE shoot.shootID = $shootid";
			
			$res_grp = mysql_query($grpsql) or die(mysql_error()); */

			while ($row=mysql_fetch_array($res_grp)) {
				$grpid=$row["groupid"];
				$grp=$row["group"];
				
				$evtsql="SELECT event.eventID AS 'eventid', event.name AS 'evname', event.year AS 'evyr'
				FROM group
				INNER JOIN event
				on group.eventID = event.eventID
				WHERE group.groupID = $grpid";
				
				$res_evt = mysql_query($evtsql) or die(mysql_error());
			
				while ($row=mysql_fetch_array($evtsql)) {
				
				$evtid=$row["eventid"];
				$evname=$row["evname"];
				$evyr=$row["evyr"];
				
				echo "<p>$evname.$evyr</p>";
				echo "<p>$grp</p>";
				echo "<p>$shootname, $total, $rank</p>";
			}
		}
	}	
?>