<?php
include '../scripts/conn.php';

$compsql="SELECT compID, surname, forename, nationality FROM competitor ORDER BY surname";
$compresult=mysql_query($compsql);

$compoptions="";

while ($row=mysql_fetch_array($compresult)) {

    $compid=$row["compID"];
    $compsur=$row["surname"];
    $compfor=$row["forename"];
    $compnat=$row["nationality"];
    $compname=$compsur.", ".$compfor." (".$compnat.")";
    $compoptions.="<OPTION VALUE=\"$compid\">".$compname;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Query Database by Shooter</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready( function () {
	
		$("#competitor").change(function() {
			var shoot_comp = $("#competitor").val();
			
			$.post( "get_competitor_results.php", {competitor: shoot_comp}, function(response) {
				//alert("form submitted:" + response);
				$("#result").empty().html(response);
			});
		});
	});
</script>

</head>



<body>
	<form id="competitors" action = "get_competitor_results.php" method = "post">
		<fieldset>
			<legend>Search by competitor</legend>
			<p>
				<label>Shooters:</label>
				<select name="competitor" id="competitor">
					<option value=0>Choose</option>
					<?=$compoptions?> 
				</select>
			</p>
		
		</fieldset>
	</form>

	<h3>Results</h3>
	<div id="result"></div>

</body>

</html>


