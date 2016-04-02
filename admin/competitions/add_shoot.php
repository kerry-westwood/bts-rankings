<?php
	// DB connection
	require '../../scripts/connection.php';
	
	// Get options for form
	
	// Get event id from POST
	$eventid = 0;
	if(isset($_GET['eventid'])){
		$eventid = $_POST['eventid'];
	}
	$eventid = mysqli_real_escape_string($con, $eventid);
	
	$sql2 = "SELECT eventID, eventname FROM event WHERE eventID = $eventid";
	if (!mysqli_query($con, $sql2)) {
		die('Error: ' . mysqli_error($con));
	} else {
		$result2 = mysqli_query($con, $sql2);
	}
	while ($row2 = mysqli_fetch_assoc($result2)) {
		$eventid2 = $row2["eventID"];
		$ename2 = $row2["eventname"];
	}
	
	// Get Meeting of selected event 
	$sql3 = "SELECT meeting.meetingID, meeting.meetingname, meeting.year, event.eventID FROM meeting INNER JOIN event ON meeting.meetingID = event.meetingID WHERE event.eventID = $eventid2";
	if (!mysqli_query($con, $sql3)) {
		die('Error: ' . mysqli_error($con));
	} else {
		$result3 = mysqli_query($con, $sql3);
	}
	while ($row3 = mysqli_fetch_array($result3)) {
		$mname2 = $row3["meetingname"];
		$meetingid2 = $row3["meetingID"];
		$myear = $row3["year"];
	}
	
	// Meetings
	$sql4 = "SELECT meetingID, meetingname FROM meeting";
	if (!mysqli_query($con, $sql4)) {
		die('Error: ' . mysqli_error($con));
	} else {
		$result4 = mysqli_query($con, $sql4);
	}

	$options4 = "";
	while ($row4 = mysqli_fetch_assoc($result4)) {
		$meetingid = $row4["meetingID"];
		$mname = $row4["meetingname"];
		$options4 .= "<OPTION VALUE=\"$meetingid\">".$mname."</option>";
	}
	
	// events
	$sql = "SELECT eventID, eventname FROM event, meeting WHERE event.meetingID = meeting.meetingID";
	if (!mysqli_query($con, $sql)) {
		die('Error: ' . mysqli_error($con));
	} else {
		$result = mysqli_query($con, $sql);
	}

	$options = "";
	while ($row = mysqli_fetch_array($result)) {
		$eventid = $row["eventID"];
		$ename = $row["eventname"];
		$options .= "<OPTION VALUE=\"$eventid\">".$ename."</option>";
	}
	
	// Form action
	$success = "";
	$e1 = "";
	$e2 = "";
	$e3 = "";
	$e4 = "";
	$e5 = "";
	// Check whether form has been submitted
	if(isset($_POST['submit'])) {
		// Declare variables
		$shootmeet = mysqli_real_escape_String($con, $_POST["shootmeet"]);
		$shootevent = mysqli_real_escape_String($con, $_POST["shootevent"]);
		$shoottype = mysqli_real_escape_String($con, $_POST["shoottype"]);
		$shootdated = mysqli_real_escape_String($con, $_POST["dated"]);
		$shootdatem = mysqli_real_escape_String($con, $_POST["datem"]);
		$shootdatey = mysqli_real_escape_String($con, $_POST["datey"]);
		if(isset($_POST["decimal"])) {
			$decimal = mysqli_real_escape_String($con, $_POST["decimal"]);
		} else {
			$decimal = "";
		}
		
		
		// Validation 
		$flag = 0;
		if($shootmeet == 0) {
			$flag = 5;
			$e5 = "Please select a meeting.";
		}
		if($shootevent == 0) {
			$flag = 1;
			$e1 = "Please select an event.";
		}
		if($shoottype == 0) {
			$flag = 2;
			$e2 = "Please select a shoot type.";
		}
		if($shootdated == 0 || $shootdatem == 0 || $shootdatey == 0) {
			$flag = 3;
			$e3 = "Please enter a date for the event.";
		}
		if($decimal == "") {
			$flag = 4;
			$e4 = "Please select whether this is decimal scored.";
		}
		
		
		// On success
		if($flag == 0) {
			$shootdate = $shootdatey."-".$shootdatem."-".$shootdated." 00:00:00";

			// Insert into DB
			$sql = "INSERT INTO shoot (eventID, type, date, decscore) VALUES ('$shootevent','$shoottype','$shootdate','$decimal')";

			if (!mysqli_query($con, $sql)) {
				die('Error: ' . mysqli_error($con));
			} else {
				$shootid = mysqli_insert_id($con);
				$success = "The shoot was added successfully!";
			}
			
			// Close connection
			mysqli_close($con);
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
    <link rel="stylesheet" href="../../style/datepicker-custom.css" />
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
				<h1>Add shoot</h1>
			</div>
			<div class="large-12 columns">
				<?php 
					if($success !== "") {
						echo "<div data-alert class=\"alert-box success\">".$success.
								"<a href=\"add_score.php?shootid=$shootid\" class=\"button right\">Add score</a><br class=\"clear\"/></div>";
						echo "<div class=\"hr\"></div>";
						echo "<h2>Add another</h2>";
					}
				?>
			</div>
			
			
			<form id="addshoot" name="addshoot" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="custom">
				<fieldset>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="shootmeeting">Meeting: <span class="req">required</span></label>
						</div>
						<div class="large-5 columns">
							<?php
								if($eventidurl == 0) {
							?>
									<select name="shootmeet" class="<?php if($e5 !== "") {echo "error";} ?>">
										<option value="0">Choose</option>
										<?php echo $options4; ?> 
									</select>
							<?php
								} else {
									echo $mname2.", ".$myear;
									echo "<input type=\"hidden\" name=\"shootmeet\" id=\"shootmeet\" value=\"$meetingid2\" />";
								}
							?>
						</div>
						<div class="large-4 columns">
							<?php 
								if($e5 !== "") {
									echo "<div data-alert class=\"alert-box alert no_marg\">".$e5."</div>";
								}
							?>
						</div>
					</div>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="shootevent">Event: <span class="req">required</span></label>
						</div>
						<div class="large-5 columns">
							<?php
								if($eventidurl == 0) {
							?>
									<select name="shootevent" class="<?php if($e1 !== "") {echo "error";} ?>">
										<option value="0">Choose</option>
										<?php echo $options; ?> 
									</select>	
							<?php
								} else {
									echo $ename2;
									echo "<input type=\"hidden\" name=\"shootevent\" id=\"shootevent\" value=\"$eventid2\" />";
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
							<label for="shoottype">Type: <span class="req">required</span></label>
						</div>
						<div class="large-3 columns">
							<select name="shoottype" class="<?php if($e2 !== "") {echo "error";} ?>">
								<option value="0">Choose</option>
								<option value = "1">Elimination 1</option>
								<option value = "2">Elimination 2</option>
								<option value = "3">Elimination 3</option>
								<option value = "4">Elimination 4</option>
								<option value = "5">Elimination 5</option>
								<option value = "6">Qualification &amp; Final</option>
								<option value = "7">Badges Match</option>
							</select>
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
							<label for="shootdate">Start Date <span class="req">required</span></label>
						</div>
						<div class="large-3 no-pad columns">
							<div class="row form-row">
								<div class="large-4 small-4 columns">
									<select id="dated" name="dated" class="<?php if($e3 !== "") {echo "error";} ?>">
										<option value="">DD</option>
										<option value="01">01</option>
										<option value="02"> 02 </option>
										<option value="03"> 03 </option>
										<option value="04"> 04 </option>
										<option value="05"> 05 </option>
										<option value="06"> 06 </option>
										<option value="07"> 07 </option>
										<option value="08"> 08 </option>
										<option value="09"> 09 </option>
										<option value="10"> 10 </option>
										<option value="11"> 11 </option>
										<option value="12"> 12 </option>
										<option value="13"> 13 </option>
										<option value="14"> 14 </option>
										<option value="15"> 15 </option>
										<option value="16"> 16 </option>
										<option value="17"> 17 </option>
										<option value="18"> 18 </option>
										<option value="19"> 19 </option>
										<option value="20"> 20 </option>
										<option value="21"> 21 </option>
										<option value="22"> 22 </option>
										<option value="23"> 23 </option>
										<option value="24"> 24 </option>
										<option value="25"> 25 </option>
										<option value="26"> 26 </option>
										<option value="27"> 27 </option>
										<option value="28"> 28 </option>
										<option value="29"> 29 </option>
										<option value="30"> 30 </option>
										<option value="31"> 31 </option>
									</select>
								</div>
								<div class="large-4 small-4 columns">
									<select id="datem" name="datem" class="<?php if($e3 !== "") {echo "error";} ?>">
										<option value="">MM</option>
										<option value="01"> 01 </option>
										<option value="02"> 02 </option>
										<option value="03"> 03 </option>
										<option value="04"> 04 </option>
										<option value="05"> 05 </option>
										<option value="06"> 06 </option>
										<option value="07"> 07 </option>
										<option value="08"> 08 </option>
										<option value="09"> 09 </option>
										<option value="10"> 10 </option>
										<option value="11"> 11 </option>
										<option value="12"> 12 </option>
									</select>
								</div>
								<div class="large-4 small-4 columns">
									<select id="datey" name="datey" class="<?php if($e3 !== "") {echo "error";} ?>">
										<option value="">YYYY</option>
										<option value="2010">2010</option>
										<option value="2011">2011</option>
										<option value="2012">2012</option>
										<option value="2013">2013</option>
										<option value="2014">2014</option>
									</select>
								</div>
							</div>
						</div>
						<div class="large-1 columns">
							<div class="calendar_icon">
								<input type="hidden" class="datepicker" />
							</div>
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
							<p class="lbl">Decimal scoring: <span class="req">required</span></p>
						</div>
						<div class="large-3 no-pad columns">
							<div class="row">
								<div class="large-3 columns">
									<label for="dec_yes" class="cus_label">
										<input name="decimal" type="radio" id="dec_yes" style="display: none;" value="1" />
										Yes</label>
								</div>
								<div class="large-3 end columns">
									<label for="dec_no" class="cus_label">
										<input name="decimal" type="radio" id="dec_no" style="display: none;" value="0" />
										No</label>
								</div>
							</div>
						</div>
						<div class="large-4 columns">
							<?php 
								if($e4 !== "") {
									echo "<div data-alert class=\"alert-box alert no_marg\">".$e4."</div>";
								}
							?>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="row action-row">
						<div class="large-2 right columns">
							<input type="submit" value="Add Shoot" class="button right" id="submit" name="submit" />
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	
	<script src="../../javascript/jquery.js"></script>
    <script src="../../javascript/foundation.min.js"></script>
	<script src="../../javascript/foundation.forms.cm.js"></script>
	<script src="../../javascript/jquery-ui.min.js" type="text/javascript"></script>
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
			
			$('.datepicker').datepicker( {
				buttonImage: '../../images/style/calendar.png',
				buttonText: "Pick a date",
				buttonImageOnly: true,
				showOn: 'button',
				showButtonPanel: true,
				currentText: "Jump to this month",
				firstDay: 1,
				showOtherMonths: true,
				dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
				onClose: function(dateText, inst) {
					$('#datey').val(dateText.split('/')[2]);
					$('#datem').val(dateText.split('/')[0]);
					$('#dated').val(dateText.split('/')[1]);
					
					// Refresh foundation
					Foundation.libs.forms.refresh_custom_select($('#datey'), true);
					Foundation.libs.forms.refresh_custom_select($('#datem'), true);
					Foundation.libs.forms.refresh_custom_select($('#dated'), true);
				}
			});
		});
	</script>
</body>
</html>