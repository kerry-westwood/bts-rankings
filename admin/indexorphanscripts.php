<?php

/* Orphan Meetings */
$meetingsql = "SELECT * FROM meeting WHERE NOT EXISTS (SELECT * FROM event WHERE event.meetingID=meeting.meetingID)";
$orphanmeeting = mysql_query($meetingsql,$con);

while ($row = mysql_fetch_array($orphanmeeting)) {
	echo "<p>" . $row['meetingname'] . ", " . $row['year'] . "</p>"
	}

/* Orphan Events */
$eventsql = "SELECT * FROM event WHERE NOT EXISTS (SELECT * FROM shoot WHERE shoot.eventID=event.eventID)";
$orphanevent = mysql_query($eventsql,$con);

while ($row = mysql_fetch_array($orphanevent)) {
	echo "<p>" . $row['eventname'] . ", " . $row['gender'] . $row['disciplineID'] . "</p>"
	}

/* Orphan Shoots */
$eventsql = "SELECT * FROM shoot WHERE NOT EXISTS (SELECT * FROM scorepr WHERE scorepr.shootID=shoot.shootID)";
$orphanshootpr = mysql_query($eventsql,$con);
$eventsql = "SELECT * FROM shoot WHERE NOT EXISTS (SELECT * FROM scorepr WHERE score3p.shootID=shoot.shootID)";
$orphanshoot3p = mysql_query($eventsql,$con);
$eventsql = "SELECT * FROM shoot WHERE NOT EXISTS (SELECT * FROM scorepr WHERE scorear.shootID=shoot.shootID)";
$orphanshootar = mysql_query($eventsql,$con);
$eventsql = "SELECT * FROM shoot WHERE NOT EXISTS (SELECT * FROM scorepr WHERE scoreap.shootID=shoot.shootID)";
$orphanshootap = mysql_query($eventsql,$con);

while ($row = mysql_fetch_array($orphanshootpr)) {
	echo "<p>" . $row['eventname'] . ", " . $row['gender'] . $row['disciplineID'] . "</p>"
	}
while ($row = mysql_fetch_array($orphanshoot3p)) {
	echo "<p>" . $row['eventname'] . ", " . $row['gender'] . $row['disciplineID'] . "</p>"
	}
while ($row = mysql_fetch_array($orphanshootar)) {
	echo "<p>" . $row['eventname'] . ", " . $row['gender'] . $row['disciplineID'] . "</p>"
	}
while ($row = mysql_fetch_array($orphanshootap)) {
	echo "<p>" . $row['eventname'] . ", " . $row['gender'] . $row['disciplineID'] . "</p>"
	}

/* Shoots not yet used to generate a rating */
$outstandprsql = "SELECT DISTINCT scoreprID, shootID FROM scorepr WHERE NOT EXISTS (SELECT scoreprID FROM ratingpr WHERE ratingpr.scoreprID=scorepr.scoreprID)";
$outstandingpr = mysql_query($outstandprsql,$con);
$outstand3psql = "SELECT score3pID, shootID FROM score3p WHERE NOT EXISTS (SELECT score3pID FROM rating3p WHERE rating3p.score3pID=score3p.score3pID)";
$outstanding3p = mysql_query($outstandprsql,$con);
$outstandarsql = "SELECT scorearID, shootID FROM scorear WHERE NOT EXISTS (SELECT scorearID FROM ratingar WHERE ratingar.scorearID=scorear.scorearID)";
$outstandingar = mysql_query($outstandarsql,$con);
$outstandprsql = "SELECT scoreapID, shootID FROM scoreap WHERE NOT EXISTS (SELECT scoreapID FROM ratingap WHERE ratingap.scoreapID=scoreap.scoreapID)";
$outstandingap = mysql_query($outstandapsql,$con);

?>