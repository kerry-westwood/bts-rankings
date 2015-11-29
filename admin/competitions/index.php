<?php
	// DB connection
	include '../../scripts/connection.php';
	// Meetings
	$sql = "SELECT meetingID, meetingname FROM meeting";
	if (!mysql_query($sql,$con)) {
		die('Error: ' . mysql_error());
	} else {
		$result = mysql_query($sql);
	}

	$options = "";
	while ($row = mysql_fetch_array($result)) {
		$meetingid = $row["meetingID"];
		$mname = $row["meetingname"];
		$options .= "<OPTION VALUE=\"$meetingid\">".$mname."</option>";
	}
?>
<!doctype html>
<!--[if lte IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en" ><!--<![endif]-->
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BTS Rankings - Admin</title>
    <link rel="stylesheet" href="../../style/normalize.css" />
    <link rel="stylesheet" href="../../style/foundation.css" />
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../style/app.css" />
    <!--[if lte IE 8]>
		<link rel="stylesheet" href="../../style/ie8-grid.css" />
	<![endif]-->
    <script src="../../javascript/modernizr.js"></script>
</head>
<body>
	<div class="row" id="main">
		<?php include("../../includes/admin/header.php"); ?>
		<div class="row">
			<div class="small-12 columns">
				<h1>Competitions Overview</h1>
			</div>
			
			<div class="small-12 columns stage01">
				<div class="small-12 columns">
					<h2>Meetings</h2>
				</div>
				<div class="small-4 columns">
					<h3>Add new meeting</h3>
					<p>Intro text here</p>
					<p><a href="add_meeting.php" title="Add meeting" class="button">Add Meeting</a></p>
				</div>
				<div class="small-8 columns">
					<h3>Upcoming meetings</h3>
					<p><em>To do</em> <a href="view_meeting.php">View this meeting</a></p>
					<p><a href="all_meetings.php" title="View all meetings" class="button">View all meetings</a>
				</div>
			</div>
			<div class="small-12 columns stage02">
				<div class="small-12 columns">
					<h2>Events</h2>
				</div>
				<div class="small-4 columns">
					<h3>Add event</h3>
					<form class="custom" method="get" id="addevent" name="addevent" action="add_event.php">
						<fieldset class="marg_top">
							<select name="meetingid" id="meetingid" class="medium">
								<option value="0">Choose meeting</option>
								<?php echo $options; ?>
							</select>
						</fieldset>
						<fieldset class="marg_top">
							<input type="submit" value="Add Event" class="button" />
						</fieldset>
					</form>
				</div>
				<div class="small-8 columns">
					<h3>Meetings without events</h3>
					<p>List of meetings that don't have any events attached to them.</p>
				</div>
			</div>
			<div class="small-12 columns stage03">
				<div class="small-12 columns">
					<h2>Shoots</h2>
				</div>
				<div class="small-4 columns">
					<h3>Add shoot</h3>
					<p><em>Need to add selects for meetings and events</em></p>
					<p><a href="add_shoot.php" title="Add shoot" class="button">Add shoot</a></p>
				</div>
				<div class="small-8 columns">
					<h3>Events without shoots</h3>
					<p>List of events that currently don't have any shoots attached</p>
				</div>
			</div>
			<div class="small-12 columns stage04">
				<div class="small-12 columns">
					<h2>Scores</h2>
				</div>
				<div class="small-4 columns">
					<h3>Add scores</h3>
					<p><em>Need to add selects for meetings, events, shoot</em></p>
					<p><a href="add_score.php" title="Add score" class="button">Add scores</a></p>
				</div>
				<div class="small-8 columns">
					<h3>Required scores</h3>
					<p>List of shoots that don't have any scores entered, or shoots that have scores but saved as in progress</p>
				</div>
			</div>
		</div>
	</div>

	<script src="../../javascript/jquery.js"></script>
    <script src="../../javascript/foundation.min.js"></script>
    <!--<script src="../javascript/foundation.accordian.js"></script>
    <script src="../javascript/foundation.clearing.js"></script>
    <script src="../javascript/foundation.reveal.js"></script>
    <script src="../javascript/foundation.tab.js"></script>
    <script src="../javascript/foundation.tooltip.js"></script>-->
	
	<script type="text/javascript">
		$(document).foundation(); 
	</script>
</body>
</html>