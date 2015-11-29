<?php
	include ("scripts/conn.php");
	
	$input_years = "";
	$input_events = "";
	
	$years_sql="SELECT `year` FROM `event` GROUP BY `year` ORDER BY `year` DESC";
	$years_result=mysql_query($years_sql);

	while ($row=mysql_fetch_array($years_result)) {
		$year_name=$row["year"];
		$input_years .= "<input type=\"radio\" value=\"$year_name\" name=\"champ_year\" /><label>$year_name</label>";
	}

?>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready( function () {
				
				function post_year() {
					//get selected year
					var year = $("#input_years input[type='radio']:checked").val();
					
					//get selected champ
					var sel_champ = "test";
					var get_champ = $("#input_champs input[type='radio']:checked").next("label").text();
					if (! get_champ) {} else {sel_champ = get_champ;}
					
					$.post( "scripts/get_champs.php", {year: year, sel_champ: sel_champ}, function(response) {
						//alert("form submitted:" + response);
						$("#input_champs").empty().html(response);
						//Check if there is a selected input in champs
						var sel_champ2 = "test";
						var get_champ2 = $("#input_champs input[type='radio']:checked").next("label").text();
						if (! get_champ2) {} else {sel_champ2 = get_champ2;}
						if(sel_champ2 !== "test") {
							post_champs();
						}
					});
				}
				
				function post_champs() {
					var champ = $("#input_champs input[type='radio']:checked").val();
					
					var sel_event = "test";
					var get_event = $("#input_events input[type='radio']:checked").next("label").text();
					if (! get_event) {} else {sel_event = get_event;}
					
					$.post( "scripts/get_events.php", {champ: champ, sel_event: sel_event}, function(response) {
						//alert("form submitted:" + response);
						$("#input_events").empty().html(response);
						var sel_event2 = "test";
						var get_event2 = $("#input_events input[type='radio']:checked").next("label").text();
						if (! get_event2) {} else {sel_event2 = get_event2;}
						if(sel_event2 !== "test") {
							post_events();
						}
					});
				}
				
				function post_events() {	
					var event = $("#input_events input[type='radio']:checked").val();
					
					$.post( "scripts/get_results.php", {event: event}, function(response) {
						//alert("form submitted:" + response);
						$("#results").empty().html(response);
					});
				}
				
				$("div#input_years > input").click( function() {
					$("#results").empty();
					post_year();
				});
				
				//use .on for dynamic elements
				$('body').on('click', 'div#input_champs > input', function() {
					$("#results").empty();
					post_champs();
				});
				$('body').on('click', 'div#input_events > input', function() {
					$("#results").empty();
					post_events();
				});
				
				
				//ON PAGE LOAD
				//Select latest year by default
				$("div#input_years > input:first-child").attr("checked", "checked");
				post_year();
				
				
			});
		</script>
	</head>
	<body>
		<form action="get_results.php" method="post" id="form_events" name="form_events">
			<fieldset>
				<label>Select Year:</label>
				<div class="container" id="input_years">
					<?php echo $input_years; ?>
				</div>
			</fieldset>
			<fieldset>
				<label>Select Championship:</label>
				<div class="container" id="input_champs">
				</div>
			</fieldset>
			<fieldset>
				<label>Select Event:</label>
				<div class="container" id="input_events">
				</div>
			</fieldset>
		</form>
		
		<div id="results">
		
		</div>
	
	</body>
</html>