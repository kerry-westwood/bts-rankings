<!DOCTYPE html>
<!-- This page selects all competitors from a specific shoot and recalculates
their live rating based on their performance in that shoot. It DOES NOT commit that rating
to the ranking system or update the rankings in any way. -->
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Ratings Generator</title>

</head>
<body>

<?php
include '../../scripts/connection.php';

$shoot = mysqli_real_escape_String($_POST["$shoot"]);

/* Select competitors and positions */

$positionsql = "SELECT scorepr.scoreprID, scorepr.shootID, scorepr.competitorID, scorepr.position,
       IFNULL((SELECT ratingpr.rating
        FROM ratingpr
        WHERE scorepr.competitorID = ratingpr.competitorID
        ORDER BY ratingpr.ratingprid DESC
        LIMIT 1
       ),1500) AS rating FROM scorepr
       WHERE scorepr.shootID = $shoot
       ORDER BY scorepr.position;";

$positionarray = mysqli_query($con, $positionsql);

/* Count number of rows */
$rows = mysqli_num_rows($positionarray);
echo "<p>Competitors: " . $rows . "</p>";

/* Sum ratings */
$sum = 0;
while ($row = mysqli_fetch_assoc($positionarray)){
    $sum += $row['rating'];
}

echo "<p>Sum of Ratings: " . $sum . "</p>";

/* Calculate competition average
[	Select competitor rating;
	Subtract competitor rating from $sum;
	Average remaining ratings]
	*/

$positionarray2 = mysqli_query($con, $positionsql);

while ($competitor = mysqli_fetch_assoc($positionarray2)){
	echo "<p>While loop running<p>";
	$rating = $competitor['rating'];
	$tempsum = $sum - $rating;
	$tempavg = $tempsum / ($rows - 1);
	$difference = $rating - $tempavg;
	
	echo "<p>" . $rating . " " . $tempsum . " " . $tempavg . " " . $difference . "</p>";

/* Set K-Value based on existing rating */ 
	if ($rating <= 2100){
		$k = 32;
	} elseif ($rating >= 2400){
		$k = 16;
	} else {
		$k = 24;
	}

		 
	$wins = $rows - $competitor['position'];
	$expectedratio = 1 / (1 + pow(10, ($difference / 400)));
	$expected = $expectedratio * ($rows - 1);
	$actual = $rating + ($k * ($wins - $expected));
	$scoreid = $competitor['scoreprID'];
	$competitorid = $competitor['competitorID'];
	
	echo "<p>" . $competitorid . " " . $wins . " " . $expectedratio . " " . $scoreid . " " . $rating . " " . $k . " " . $actual . "</p>";
	
	$sql = "INSERT INTO ratingpr (scoreprID, competitorID, rating)
	VALUES ('$scoreid', '$competitorid', '$actual')";
	
	if (!mysqli_query($con, $sql)) {
		die('Error: ' . mysql_error());
	} else {
		echo "Yay it worked";
	}
	
	}

?>

</body>
</html>


