<?php
	// DB connection
	include '../../scripts/connection.php';
	
	// Get options for form
	// Get meeting id from url
	$meetingidurl = 0;
	if(isset($_GET['meetingid'])){
		$meetingidurl = $_GET['meetingid'];
	}
	$sql1 = "SELECT meetingID, meetingname FROM meeting WHERE meetingID = $meetingidurl";
	if (!mysql_query($sql1,$con)) {
		die('Error: ' . mysql_error());
	} else {
		$result1 = mysql_query($sql1);
	}
	while ($row1 = mysql_fetch_array($result1)) {
		$meetingid1 = $row1["meetingID"];
		$mname1 = $row1["meetingname"];
	}
	
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
	
	// Disciplines
	$dsql = "SELECT disciplineID, name FROM discipline";
	if (!mysql_query($sql,$con)) {
		die('Error: ' . mysql_error());
	} else {
		$dresult = mysql_query($dsql);
	}
	
	$doptions="";
	while ($row = mysql_fetch_array($dresult)) {
		$disciplineid = $row["disciplineID"];
		$disciplinename = $row["name"];
		$doptions .= "<OPTION VALUE=\"$disciplineid\">".$disciplinename."</option>";
	}
	
	// Form action
	$success = "";
	$e1 = "";
	$e2 = "";
	$e3 = "";
	
	// Check whether form has been submitted
	if(isset($_POST['submit'])) {
		// Declare variables
		$eventmeeting = mysql_real_escape_String($_POST["eventmeeting"]);
		$eventname = mysql_real_escape_String($_POST["eventname"]);
		$eventdiscipline = mysql_real_escape_String($_POST["eventdiscipline"]);
		$gender = mysql_real_escape_String($_POST["gender"]);
		$entrants = mysql_real_escape_String($_POST["entrants"]);
		
		// Validation 
		$flag = 0;
		
		if($eventmeeting == 0) {
			$flag = 1;
			$e1 = "Please choose a meeting.";
		}		
		if(strlen($eventname) <= 1) {
			$flag = 2;
			$e2 = "Please enter an event name.";
		}
		if($eventdiscipline == 0) {
			$flag = 3;
			$e3 = "Please select a discipline.";
		}
		
		// On success
		if($flag == 0) {
			
			if($entrants == "") {
				$entrants = "NULL";
			} else {
				$entrants = "'$entrants'";
			}
			if($gender == 0) {
				$gender = "NULL";
			} else {
				$gender = "'$gender'";
			}

			// Insert into DB
			$sql = "INSERT INTO event (meetingID, eventname, disciplineID, entrants, gender) ".
					"VALUES ('$eventmeeting', '$eventname', '$eventdiscipline', $entrants, $gender)";
			
			if (!mysql_query($sql,$con)) {
				die('Error: ' . mysql_error());
			} else {
				$eventid = mysql_insert_id();
				$success = "\"".$eventname."\" was added successfully!";
			}
			
			// Close connection
			mysql_close($con);
		}	
	}
?>
<!doctype html>
<!--[if lte IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en" ><!--<![endif]-->
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BTS Rankings - Admin/Competitions</title>
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
			<div class="large-12 columns">
				<h1>Add Event</h1>
			</div>
			<div class="large-12 columns">
				<?php 
					if($success !== "") {
						echo "<div data-alert class=\"alert-box success\">".$success.
								"<a href=\"add_shoot.php?eventid=$eventid\" class=\"button right\">Add shoot</a><br class=\"clear\"/></div>";
						echo "<div class=\"hr\"></div>";
						echo "<h2>Add another</h2>";
					}
				?>
			</div>
			
			
			<form id="addevent" name="addevent" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="custom">
				<fieldset>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="eventmeeting">Meeting: <span class="req">required</span></label>
						</div>
						<div class="large-5 columns">
						<?php
							if($meetingidurl == 0) {
						?>
								<select name="eventmeeting" class="<?php if($e1 !== "") {echo "error";} ?>">
									<option value="0">Choose</option>
									<?php echo $options; ?> 
								</select>
						<?php
							} else {
								echo $mname1;
								echo "<input type=\"hidden\" name=\"eventmeeting\" id=\"eventmeeting\" value=\"$meetingid1\" />";
							}
						?>
						</div>
						<div class="large-4 columns">
							<?php 
								if($e1 !== "") {
									echo "<div data-alert class=\"alert-box alert no_marg\">".$e1."</div>";
								}
							?>
						</div>
					</div>
					
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="eventname">Event Name: <span class="req">required</span></label>
						</div>
						<div class="large-5 columns">
							<input type="text" id="eventname" name="eventname" class="text_input <?php if($e2 !== "") {echo "error";} ?>" value="" />
						</div>
						<div class="large-4 columns">
							<?php 
								if($e2 !== "") {
									echo "<div data-alert class=\"alert-box alert no_marg\">".$e2."</div>";
								}
							?>
						</div>
					</div>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="eventdiscipline">Discipline: <span class="req">required</span></label>
						</div>
						<div class="large-3 end columns">
							<select name="eventdiscipline" class="<?php if($e3 !== "") {echo "error";} ?>">
								<option value="0">Choose</option>
								<?php echo $doptions; ?>
							</select>
						</div>
						<div class="large-4 columns">
							<?php 
								if($e3 !== "") {
									echo "<div data-alert class=\"alert-box alert no_marg\">".$e3."</div>";
								}
							?>
						</div>
					</div>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="gender">Gender:</label>
						</div>
						<div class="large-2 end columns">
							<select name="gender">
								<option value="0">Choose</option>
								<option value="1">Men</option>
								<option value="2">Women</option>
								<option value="3">Mixed</option>
								<option value="4">Junior Men</option>
								<option value="5">Junior Women</option>
							</select>
						</div>
					</div>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="entrants">Number of entrants:</label>
						</div>
						<div class="large-2 end columns">
							<input type="text" id="entrants" name="entrants" class="text_input small-6" value="" autocomplete="off" />
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="row action-row">
						<div class="large-2 right columns">
							<input type="submit" value="Add Event" class="button right" id="submit" name="submit" />
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	
	<script src="../../javascript/jquery.js"></script>
    <script src="../../javascript/foundation.min.js"></script>
	<script src="../../javascript/foundation.forms.cm.js"></script>
    <!--<script src="../javascript/foundation.accordian.js"></script>
    <script src="../javascript/foundation.clearing.js"></script>
    <script src="../javascript/foundation.reveal.js"></script>
    <script src="../javascript/foundation.tab.js"></script>
    <script src="../javascript/foundation.tooltip.js"></script>-->
	
	<script type="text/javascript">
		$(document).foundation(); 
		// Mobile Detection 
        function detectmob() { 
         if( navigator.userAgent.match(/Android/i)
         || navigator.userAgent.match(/webOS/i)
         || navigator.userAgent.match(/iPhone/i)
         || navigator.userAgent.match(/iPad/i)
         || navigator.userAgent.match(/iPod/i)
         || navigator.userAgent.match(/BlackBerry/i)
         || navigator.userAgent.match(/Windows Phone/i)
         ){
            return true;
          }
         else {
            return false;
          }
        }
		
		$(document).ready(function () {
			
			if(detectmob() == true){
				$("select").css({
					"display": "inline", 
					"position": "relative", 
					"margin-left": "0px",
					"visibility": "visible"
				});
				$("form.custom div.custom.dropdown").css("display", "none");
			}
		});
	</script>
</body>
</html>