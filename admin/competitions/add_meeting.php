<?php
	$success = "";
	$e1 = "";
	
	// Check whether form has been submitted
	if(isset($_POST['submit'])) {
		require '../../scripts/connection.php';
		
		// Declare variables
		$meetingname = mysqli_real_escape_String($con, $_POST["meetingname"]);
		$meetingyear = mysqli_real_escape_String($con, $_POST["meetingyear"]);
		
		// Validation 
		$flag = 0;
		
		if(strlen($meetingname) <= 1) {
			$flag = 1;
			$e1 = "Please enter a Meeting Name";
		}		
		
		// On success
		if($flag == 0) {
						
			// Insert into DB
			$sql = "INSERT INTO meeting (meetingname, year) VALUES ('$meetingname','$meetingyear')";
			
			if (!mysqli_query($con, $sql)) {
				die('Error: ' . mysqli_error($con));
			} else {
				$meetingid = mysqli_insert_id($con);
				$success = "\"".$meetingname."\" was added successfully!";
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
				<h1>Add Meeting</h1>
			</div>
			<div class="large-12 columns">
				<?php 
					if($success !== "") {
						echo "<div data-alert class=\"alert-box success\">".$success.
								"<a href=\"add_event.php?meetingid=$meetingid\" class=\"button right\">Add event</a><br class=\"clear\"/></div>";
						echo "<div class=\"hr\"></div>";
						echo "<h2>Add another</h2>";
					}
				?>
			</div>
			<form id="AddMeeting" name="AddMeeting" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="custom">
				<fieldset>
					<div class="row form-row">
						<div class="large-3 columns">
							<label for="meetingname">Meeting Name: <span class="req">required</span></label>
						</div>
						<div class="large-5 columns">
							<input type="text" id="meetingname" name="meetingname" class="text_input <?php if($e1 !== "") {echo "error";} ?>" value="" autocomplete="off" />
							
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
							<label for="meetingyear">Year: <span class="req">required</span></label>
						</div>
						<div class="large-2 end columns">
							<select id="meetingyear" name="meetingyear">
								<?php
									$curYear = date("Y");
									$minYear = $curYear - 10;
									$maxYear = $curYear + 10;
									
									for ($i = $minYear; $i <= $maxYear; $i++) {
										if($i == $curYear) {
											echo "<option value=\"$i\"\ selected=\"selected\">$i</option>";
										} else {
											echo "<option value=\"$i\">$i</option>";
										}
									}
								?>
							</select>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="row action-row">
						<div class="large-2 right columns">
							<input type="submit" value="Add Meeting" class="button right" id="submit" name="submit" />
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