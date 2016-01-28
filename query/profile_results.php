<?php
//Fetches competition results for a given Competitor

function getPR($competitorID) {
	$competitorid = mysql_real_escape_String($competitorID);

	//Get Competitor Prone Results
	$prsql="SELECT scorepr.*, shoot.*, event.*, meeting.*, (
				SELECT ratingpr.rating
				FROM ratingpr
				WHERE scorepr.scoreprID = ratingpr.scoreprID
				) AS rating
				FROM scorepr
				INNER JOIN shoot ON scorepr.shootID = shoot.shootID
				INNER JOIN event ON shoot.eventID = event.eventID
				INNER JOIN meeting ON event.meetingID = meeting.meetingID
				WHERE scorepr.competitorID = $competitorid
				ORDER BY scorepr.scoreprID DESC";

	$prresults = mysql_query($prsql) or die(mysql_error());
	$resultsPR = mysql_fetch_array($prresults);
	return $resultsPR;
}
	
function getTP($competitorID) {
	$competitorid = mysql_real_escape_String($competitorID);

	//Get Competitor 3P Results
	$tpsql="SELECT scoretp.*, shoot.*, event.*, meeting.*, (
				SELECT ratingtp.rating
				FROM ratingtp
				WHERE scoretp.scoretpID = ratingtp.scoretpID
				) AS rating
				FROM scoretp
				INNER JOIN shoot ON scoretp.shootID = shoot.shootID
				INNER JOIN event ON shoot.eventID = event.eventID
				INNER JOIN meeting ON event.meetingID = meeting.meetingID
				WHERE scoretp.competitorID = $competitorid
				ORDER BY scoretp.scoretpID DESC";

	$tpresults = mysql_query($tpsql) or die(mysql_error());
	$resultsTP= mysql_fetch_array($tpresults);
	return $resultsTP;
}

function getAR($competitorID) {
	$competitorid = mysql_real_escape_String($competitorID);

	//Get Competitor Air Rifle Results
	$arsql="SELECT scorear.*, shoot.*, event.*, meeting.*, (
				SELECT ratingar.rating
				FROM ratingar
				WHERE scorear.scorearID = ratingar.scorearID
				) AS rating
				FROM scorear
				INNER JOIN shoot ON scorear.shootID = shoot.shootID
				INNER JOIN event ON shoot.eventID = event.eventID
				INNER JOIN meeting ON event.meetingID = meeting.meetingID
				WHERE scorear.competitorID = $competitorid
				ORDER BY scorear.scorearID DESC";

	$arresults = mysql_query($arsql) or die(mysql_error());
	$resultsAR = mysql_fetch_array($arresults);
	return $resultsAR;
}

function getAP($competitorID) {
	$competitorid = mysql_real_escape_String($competitorID);

	//Get Competitor Air Pistol Results
	$apsql="SELECT scoreap.*, shoot.*, event.*, meeting.*, (
				SELECT ratingap.rating
				FROM ratingap
				WHERE scoreap.scoreapID = ratingap.scoreapID
				) AS rating
				FROM scoreap
				INNER JOIN shoot ON scoreap.shootID = shoot.shootID
				INNER JOIN event ON shoot.eventID = event.eventID
				INNER JOIN meeting ON event.meetingID = meeting.meetingID
				WHERE scoreap.competitorID = $competitorid
				ORDER BY scoreap.scoreapID DESC";

	$apresults = mysql_query($apsql) or die(mysql_error());
	$resultsAP = mysql_fetch_array($apresults);
	return $resultsAP;
}	
	
/*	

while ($row=mysql_fetch_array($prresults)) {
	$meeting_name=$row["meeting.meetingname"];
	$meeting_year=$row["meeting.year"];
	$event_name=$row["event.eventname"];
	$shoot_type=$row["shoot.type"];
	$shoot_date=$row["shoot.date"];
	$decimal=$row["shoot.decscore"];
	$s1=$row["scorepr.1"];
	$s2=$row["scorepr.2"];
	$s3=$row["scorepr.3"];
	$s4=$row["scorepr.4"];
	$s5=$row["scorepr.5"];
	$s6=$row["scorepr.6"];
	$total=$row["scorepr.total"];
	$f1=$row["scorepr.f1"];
	$f2=$row["scorepr.f2"];
	$f3=$row["scorepr.f3"];
	$f4=$row["scorepr.f4"];
	$f5=$row["scorepr.f5"];
	$f6=$row["scorepr.f6"];
	$f7=$row["scorepr.f7"];
	$f8=$row["scorepr.f8"];
	$f9=$row["scorepr.f9"];
	$final=$row["scorepr.final"];
	$notes=$row["scorepr.notes"];
	$position=$row["scorepr.position"];
	$rating=$row["ratingpr.rating"];
	} */
?>