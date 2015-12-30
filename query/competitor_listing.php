<?php
include '../scripts/conn.php';

/* Select Competitor Details and checks which Disciplines they have results for. */

$compsql=	"SELECT competitorID, surname, forename, nationality, gender,
		IFNULL((SELECT scorepr.competitorID
         FROM scorepr
         WHERE competitor.competitorID = scorepr.competitorID
         ORDER BY scorepr.scoreprID DESC
         LIMIT 1
       ),0) AS prone, 
       IFNULL((SELECT score3p.competitorID
         FROM score3p
         WHERE competitor.competitorID = score3p.competitorID
         ORDER BY score3p.score3pID DESC
         LIMIT 1
       ),0) AS 3p, 
       IFNULL((SELECT scorear.competitorID
         FROM scorear
         WHERE competitor.competitorID = scorear.competitorID
         ORDER BY scorear.scorearID DESC
         LIMIT 1
       ),0) AS ar, 
       IFNULL((SELECT scoreap.competitorID
         FROM scoreap
         WHERE competitor.competitorID = scoreap.competitorID
         ORDER BY scoreap.scoreapID DESC
         LIMIT 1
       ),0) AS ap
FROM competitor
ORDER BY surname";

$compresult=mysql_query($compsql);

/* Clears $compoptions */

/* $compoptions=""; */

/* Outputs to php array, inserts values to $compoptions to populate drop-down in form */

while ($row=mysql_fetch_array($compresult)) {

    $compid=$row["compID"];
    $compsur=$row["surname"];
    $compfor=$row["forename"];
    $compnat=$row["nationality"];
    $compgen=$row["gender"];
    $comppr=$row["prone"];
    $comp3p=$row["3p"];
    $compar=$row["ar"];
    $compap=$row["ap"];
    $compname=$compsur.", ".$compfor." (".$compnat.")";
    /* $compoptions.="<OPTION VALUE=\"$compid\">".$compname; */
	}
?>




<!--
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

</html> -->