<?php
include '../scripts/conn.php';

$eventsql="SELECT eventID, name FROM event";
$eventresult=mysql_query($eventsql);

$eventoptions="";

while ($row=mysql_fetch_array($eventresult)) {

    $eventid=$row["eventID"];
    $ename=$row["name"];
    $eventoptions.="<OPTION VALUE=\"$eventid\">".$ename."</option>";
}

/* if form has been submitted 
if(isset($_POST['submit'])) {
    $event = $_POST["shootevent"];
	$event = mysql_real_escape_String($event);

	$sql="SELECT shootID, name, courseID FROM shoot WHERE eventID = $event";

	$event_res = mysql_query($sql) or die(mysql_error());
}*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Query Database</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready( function () {
	
		$("#shootevent").change(function() {
			var shoot_event = $("#shootevent").val();
			
			$.post( "get_events.php", {shootevent: shoot_event}, function(response) {
				//alert("form submitted:" + response);
				$("#result").empty().html(response);
			});
		});
		
		/* THIS NO LONGER NEEDED - Submit form on select change */
		//$("#events").submit(function(event) {
			 /* stop form from submitting normally */
			//event.preventDefault();
			/* get some values from elements on the page: */
			//var $form = $(this),
				//form_data = $(this).serialize(),
				//shoot_event = $("#shootevent").val();
				//url = $form.attr('action');
			
			//alert(form_data); //for testing
			
			/* Send the data using post */
			
			//$.post( url, {shootevent: shoot_event}, function(response) {
				//alert("form submitted:" + response); //for testing
				//$("#result").empty().html(response);
			//});
			
		//});
	
	});
</script>

</head>



<body>
	<form id="events" action = "get_events.php" method = "post">
		<fieldset>
			<legend>Search by Event</legend>
			<p>
				<label>Events:</label>
				<select name="shootevent" id="shootevent">
					<option value=0>Choose</option>
					<?=$eventoptions?> 
				</select>
			</p>
			<!--<input type = "submit" value = "Find Shoots" name="submit" id="submit" />-->
		</fieldset>
	</form>

	<h3>Results</h3>
	<div id="result"></div>
<?php 
	/*If form has been submitted, output results 
	if(isset($_POST['submit'])) {
		while ($row=mysql_fetch_array($event_res)) {

			$shootid=$row["shootID"];
			$name=$row["name"];
			$courseid=$row["courseID"];
			echo "<p>$shootid, $name, $courseid</p>";
		}
	}*/
?>
</body>

</html>


