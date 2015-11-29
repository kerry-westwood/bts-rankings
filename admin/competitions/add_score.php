<?php
	// DB connection
	include '../../scripts/connection.php';
	
	// Get options for form
	// Get shoot id from url
	$shootidurl = 0;
	if(isset($_GET['shootid'])){
		$shootidurl = $_GET['shootid'];
		
		$sql1 = "SELECT shootID, type FROM shoot WHERE shootID = $shootidurl";
		if (!mysql_query($sql1,$con)) {
			die('Error: ' . mysql_error());
		} else {
			$result1 = mysql_query($sql1);
		}
		while ($row1 = mysql_fetch_array($result1)) {
			$shootid2 = $row1["shootID"];
			$shoottype = $row1["type"];
			$shoottypename = "";
			switch ($shoottype) {
				case 1 :
					$shoottypename = "Elimination 1";
				break;
				case 2 :
					$shoottypename = "Elimination 2";
				break;
				case 3 :
					$shoottypename = "Elimination 3";
				break;
				case 4 :
					$shoottypename = "Elimination 4";
				break;
				case 5 :
					$shoottypename = "Elimination 5";
				break;
				case 6 :
					$shoottypename = "Qualification &amp; Final";
				break;
				case 7 :
					$shoottypename = "Badges";
				break;
			}
		}
		
		// Get event of shoot 
		$sql2 = "SELECT event.eventID, event.eventname, shoot.shootID FROM event INNER JOIN shoot ON event.eventID = shoot.eventID WHERE shoot.shootID = $shootid2";
		if (!mysql_query($sql2,$con)) {
			die('Error: ' . mysql_error());
		} else {
			$result2 = mysql_query($sql2);
		}
		while ($row2 = mysql_fetch_array($result2)) {
			$eventid = $row2["eventID"];
			$eventname = $row2["eventname"];
		}
		
		// Get Meeting of selected shoot 
		$sql3 = "SELECT meeting.meetingID, meeting.meetingname, meeting.year, event.eventID FROM meeting INNER JOIN event ON meeting.meetingID = event.meetingID WHERE event.eventID = $eventid";
		if (!mysql_query($sql3,$con)) {
			die('Error: ' . mysql_error());
		} else {
			$result3 = mysql_query($sql3);
		}
		while ($row3 = mysql_fetch_array($result3)) {
			$meetingname = $row3["meetingname"];
			$meetingid = $row3["meetingID"];
			$meetingyear = $row3["year"];
		}
	
	}
	
	// Get all meetings
	$sql4 = "SELECT meetingID, meetingname, year FROM meeting";
	if (!mysql_query($sql4,$con)) {
		die('Error: ' . mysql_error());
	} else {
		$result4 = mysql_query($sql4);
	}

	$options4 = "";
	while ($row4 = mysql_fetch_array($result4)) {
		$meetingid = $row4["meetingID"];
		$mname = $row4["meetingname"];
		$myear = $row4["year"];
		$options4 .= "<OPTION VALUE=\"$meetingid\">".$mname.", ".$myear."</option>";
	}
	
	// shoots
	$shootsql = "SELECT shootID, meetingname, year, eventname, type ".
				"FROM shoot, event, meeting WHERE shoot.eventID = event.eventID ".
				"AND event.meetingID = meeting.meetingID ORDER BY shootID DESC";
	if (!mysql_query($shootsql,$con)) {
		die('Error: ' . mysql_error());
	} else {
		$shootresult = mysql_query($shootsql);
	}
	
	$shootoptions = "";
	while ($row = mysql_fetch_array($shootresult)) {
		$shootid = $row["shootID"];
		$mname = $row["meetingname"];
		$year = $row["year"];
		$ename = $row["eventname"];
		$type = $row["type"];
		$shootname = $mname." ".$year.", ".$ename.", ".$type;
		$shootoptions .= "<OPTION VALUE=\"$shootid\">".$shootname."</option>";
	}
	
	// competitors
	$compsql = "SELECT competitorID, surname, forename, nationality FROM competitor ORDER BY surname";
	if (!mysql_query($compsql,$con)) {
		die('Error: ' . mysql_error());
	} else {
		$compresult = mysql_query($compsql);
	}

	$compoptions = "";

	while ($row = mysql_fetch_array($compresult)) {
		$compid = $row["competitorID"];
		$compsur = $row["surname"];
		$compfor = $row["forename"];
		$compnat = $row["nationality"];
		$compname = $compsur.", ".$compfor." (".$compnat.")";
		$compoptions .= "<OPTION VALUE=\"$compid\">".$compname."</option>";
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
		$shoot = $_POST["shoot"];
		$competitor = $_POST["competitor"];
		$q1 = $_POST["q1"];
		$q2 = $_POST["q2"];
		$q3 = $_POST["q3"];
		$q4 = $_POST["q4"];
		$q5 = $_POST["q5"];
		$q6 = $_POST["q6"];
		$qtotal = $_POST["qtotal"];
		//echo "qual total: ".$qtotal;
		$f1 = $_POST["f1"];
		$f2 = $_POST["f2"];
		$f3 = $_POST["f3"];
		$f4 = $_POST["f4"];
		$f5 = $_POST["f5"];
		$f6 = $_POST["f6"];
		$f7 = $_POST["f7"];
		$f8 = $_POST["f8"];
		$f9 = $_POST["f9"];
		$final = $_POST["final"];
		//echo "final total: ".$final;
		$notes = $_POST["notes"];
		$position = $_POST["position"];
		
		// Validation 
		$flag = 0;
		
		// On success
		if($flag == 0) {
			
			// Escape variables
			$shoot = mysql_real_escape_String($shoot);
			$competitor = mysql_real_escape_String($competitor);
			$q1 = mysql_real_escape_String($q1);
			$q2 = mysql_real_escape_String($q2);
			$q3 = mysql_real_escape_String($q3);
			$q4 = mysql_real_escape_String($q4);
			$q5 = mysql_real_escape_String($q5);
			$q6 = mysql_real_escape_String($q6);
			$qtotal = mysql_real_escape_String($qtotal);
			$f1 = mysql_real_escape_String($f1);
			$f2 = mysql_real_escape_String($f2);
			$f3 = mysql_real_escape_String($f3);
			$f4 = mysql_real_escape_String($f4);
			$f5 = mysql_real_escape_String($f5);
			$f6 = mysql_real_escape_String($f6);
			$f7 = mysql_real_escape_String($f7);
			$f8 = mysql_real_escape_String($f8);
			$f9 = mysql_real_escape_String($f9);
			$final = mysql_real_escape_String($final);
			$notes = mysql_real_escape_String($notes);
			$position = mysql_real_escape_String($position);
			
			// Insert into DB
			$sql = "INSERT INTO scorepr VALUES ('','$shoot','$competitor','$q1','$q2','$q3','$q4','$q5','$q6','$qtotal','$f1','$f2','$f3','$f4','$f5','$f6','$f7','$f8','$f9','$final','$notes','$position');";

			if (!mysql_query($sql,$con)) {
				die('Error: ' . mysql_error());
			} else {
				$success = "<p>The score was added successfully!</p>";
				/*header ("Location: addscoreform.php"); */
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
				<h1>Add score</h1>
			</div>
			<div class="large-12 columns">
				<?php 
					if($success !== "") {
						echo "<div data-alert class=\"alert-box success\">".$success."</div>";
						echo "<div class=\"hr\"></div>";
						echo "<h2>Add another</h2>";
					}
				?>
			</div>
			
			<form id="addscore" name="addscore" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="custom">
				<fieldset>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="eventmeeting">Meeting: <span class="req">required</span></label>
						</div>
						<div class="large-5 columns">
						<?php
							if($shootidurl == 0) {
						?>
								<select name="eventmeeting" id="eventmeeting" class="<?php if($e3 !== "") {echo "error";} ?>">
									<option value="0">Choose</option>
									<?php echo $options4; ?> 
								</select>
						<?php
							} else {
								echo $meetingname.", ".$meetingyear;
								echo "<input type=\"hidden\" name=\"shootmeeting\" id=\"shootmeeting\" value=\"$meetingid\" />";
							}
						?>
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
							<label for="shootevent">Event: <span class="req">required</span></label>
						</div>
						<div class="large-5 columns">
							<?php
								if($shootidurl == 0) {
							?>
									<span id="event_hldr">[Choose meeting]</span>
									<div id="shootevent_hldr">
										<select name="shootevent" id="shootevent" class="<?php if($e2 !== "") {echo "error";} ?>">
											<option value="0">Choose</option>
										</select>
									</div>
							<?php
								} else {
									echo $eventname;
									echo "<input type=\"hidden\" name=\"shootevent\" id=\"shootevent\" value=\"$eventid\" />";
								}
							?>
							
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
							<label for="shoot">Shoot: <span class="req">required</span></label>
						</div>
						<div class="large-5 columns">
							<?php
								if($shootidurl == 0) {
							?>
								<span id="shoot_hldr">[Choose event]</span>
								<div id="shootsel_hldr">
									<select name="shoot" id="shoot" class="<?php if($e1 !== "") {echo "error";} ?>">
										<option value="0">Choose</option>
									</select>
								</div>
							<?php
								} else {
									echo $shoottypename;
									echo "<input type=\"hidden\" name=\"shoot\" id=\"shoot\" value=\"$shootid2\" />";
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
							<label for="competitor">Competitor:</label>
						</div>
						<div class="large-5 columns">
							<select name="competitor">
								<option value="0">Choose</option>
								<?php echo $compoptions; ?> 
							</select>
						</div>
						<div class="large-4 columns">
							<?php 
								if($e4 !== "") {
									echo "<div data-alert class=\"alert-box alert no_marg\">".$e4."</div>";
								}
							?>
						</div>
					</div>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="position">Position: <span class="req">required</span></label>
						</div>
						<div class="large-2 columns">
						<input type="text" id="position" name="position" class="text_input <?php if($e5 !== "") {echo "error";} ?>" value="" />
						</div>
						<div class="large-4 columns">
							<?php 
								if($e5 !== "") {
									echo "<div data-alert class=\"alert-box alert no_marg\">".$e5."</div>";
								}
							?>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="row form-row">
						<div class="large-3 columns">
							<label>Qualification scores:</label>
						</div>
						<div class="large-9 columns no-pad">
							<div class="medium-1 columns">
								<label for="q1" class="hide">Q1</label>
								<input type="text" id="q1" name="q1" class="text_input qual" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="q2" class="hide">Q2</label>
								<input type="text" id="q2" name="q2" class="text_input qual" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="q3" class="hide">Q3</label>
								<input type="text" id="q3" name="q3" class="text_input qual" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="q4" class="hide">Q4</label>
								<input type="text" id="q4" name="q4" class="text_input qual" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="q5" class="hide">Q5</label>
								<input type="text" id="q5" name="q5" class="text_input qual" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="q6" class="hide">Q6</label>
								<input type="text" id="q6" name="q6" class="text_input qual" value="" />
							</div>
							<div class="medium-2 columns">
								<label for="qtotal" class="hide">Total</label>
								<input type="text" id="qtotal" name="qtotal" class="text_input" value="" placeholder="total" />
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="row form-row">
						<div class="large-3 columns">
							<p class="lbl">In final? <span class="req">required</span></p>
						</div>
						<div class="large-8 end columns">
							<div class="row">
								<div class="large-2 columns">
									<label for="final_yes" class="cus_label">
										<input name="finalr" type="radio" id="final_yes" style="display: none;" value="1" class="finalrdo" />
										Yes</label>
								</div>
								<div class="large-2 end columns">
									<label for="final_no" class="cus_label">
										<input name="finalr" type="radio" id="final_no" style="display: none;" value="0" class="finalrdo" checked="checked" />
										No</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row form-row" id="finalScores">
						<div class="large-3 columns">
							<label>Final scores:</label>
						</div>
						<div class="large-9 columns no-pad">
							<div class="medium-1 columns">
								<label for="f1" class="hide">F1</label>
								<input type="text" id="f1" name="f1" class="text_input fin" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="f2" class="hide">F2</label>
								<input type="text" id="f2" name="f2" class="text_input fin" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="f3" class="hide">F3</label>
								<input type="text" id="f3" name="f3" class="text_input fin" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="f4" class="hide">F4</label>
								<input type="text" id="f4" name="f4" class="text_input fin" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="f5" class="hide">F5</label>
								<input type="text" id="f5" name="f5" class="text_input fin" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="f6" class="hide">F6</label>
								<input type="text" id="f6" name="f6" class="text_input fin" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="f7" class="hide">F7</label>
								<input type="text" id="f7" name="f7" class="text_input fin" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="f8" class="hide">F8</label>
								<input type="text" id="f8" name="f8" class="text_input fin" value="" />
							</div>
							<div class="medium-1 columns">
								<label for="f9" class="hide">F9</label>
								<input type="text" id="f9" name="f9" class="text_input fin" value="" />
							</div>
							<div class="medium-2 columns">
								<label for="final" class="hide">Final total</label>
								<input type="text" id="final" name="final" class="text_input" value="" placeholder="total" />
							</div>
						</div>
					</div>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="notes">Notes:</label>
						</div>
						<div class="large-5 end columns">
							<textarea id="notes" name="notes" rows="5" cols="50"></textarea>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="row action-row">
						<div class="large-2 right columns">
							<input type="submit" value="Add Score" class="button right" id="submit" name="submit" />
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
			
			function updateQual() {
				var qualTot = 0;
				$("input.qual").each(function() {
					var qualScore = $(this).val();
					if (qualScore !== "") {
						qualScore = parseFloat(qualScore);
						qualTot = qualTot + qualScore;
						/*console.log(qualTot);*/
					}
				})
				$("input#qtotal").val(qualTot);
				/*console.log($("input#qtotal").val());*/
			}
			function updateFinal() {
				var finTot = 0;
				$("input.fin").each(function() {
					var finScore = $(this).val();
					if (finScore !== "") {
						finScore = parseFloat(finScore);
						finTot = finTot + finScore;
						/*console.log(qualTot);*/
					}
				})
				$("input#final").val(finTot);
			}
			
			function getEvents (meetingID) {
				$.post( "../functions/get_events_by_meetingid.php", {meetingID: meetingID}, function(response) {
						//alert("form submitted:" + response);
						$("#shootevent").empty().html(response);
						// Refresh foundation
						Foundation.libs.forms.refresh_custom_select($("#shootevent"), true);
						$("#event_hldr").hide();
						$("#shootevent_hldr").show();
					});
			}
			function getShoots (eventID) {
				$.post( "../functions/get_shoots_by_eventid.php", {eventID: eventID}, function(response) {
						//alert("form submitted:" + response);
						$("#shoot").empty().html(response);
						// Refresh foundation
						Foundation.libs.forms.refresh_custom_select($("#shoot"), true);
						$("#shoot_hldr").hide();
						$("#shootsel_hldr").show();
					});
			}
			
			$("#finalScores").hide();
			$("input.finalrdo").change(function() {
				var rdoVal = $("input.finalrdo:checked").val();
				if (rdoVal == "1") {
					$("#finalScores").slideDown();
				} else if (rdoVal == "0") {
					$("#finalScores").slideUp();
				}
			});
			
			$("input.qual").change( function() {
				updateQual();
			});
			$("input.fin").change( function() {
				updateFinal();
			});
			
			$("#shootevent_hldr").hide();
			$("#shootsel_hldr").hide();
			$("select#eventmeeting").change(function() {
				$("#shootevent_hldr").hide();
				$("#shootsel_hldr").hide();
				$("#event_hldr").show();
				$("#shoot_hldr").show();
				var meetingid = $(this).val();
				//console.log(meetingid);
				if(meetingid !== "0") {
					getEvents(meetingid);
				}
			});
			//use .on for dynamic elements
			$("body").on("change", "select#shootevent", function() {
				$("#shootsel_hldr").hide();
				$("#shoot_hldr").show();
				var eventid = $(this).val();
				//console.log(eventid);
				if(eventid !== "0") {
					getShoots(eventid);
				}
			});
		});
	</script>
</body>
</html>
	