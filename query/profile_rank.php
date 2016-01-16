<? php

// Collects latest ranking data for Competitor Profile Page 

include "../scripts/conn.php";

// Grabs competitorID & sanitises input
$competitorid = $_GET["profile"];
$competitorid = mysql_real_escape_String($competitorid);

// Get ratingID for Competitor

$pridsql = "SELECT MAX(ratingprID) AS prid
				FROM ratingpr
				WHERE competitorID = $competitorid";
$3pidsql = "SELECT MAX(rating3pID) AS 3pid
				FROM rating3p
				WHERE competitorID = $competitorid";
$aridsql = "SELECT MAX(ratingarID) AS arid
				FROM ratingar
				WHERE competitorID = $competitorid";
$apidsql = "SELECT MAX(ratingapID) AS apid
				FROM ratingap
				WHERE competitorID = $competitorid";
				
$prid = mysql_query($pridsql) or die(mysql_error());
$3pid = mysql_query($3pidsql) or die(mysql_error());
$arid = mysql_query($aridsql) or die(mysql_error());
$apid = mysql_query($apidsql) or die(mysql_error());

while ($row=mysql_fetch_array($prid)) {$prid=$row["prid"];}
while ($row=mysql_fetch_array($3pid)) {$3pid=$row["3pid"];}
while ($row=mysql_fetch_array($arid)) {$arid=$row["arid"];}
while ($row=mysql_fetch_array($apid)) {$apid=$row["apid"];}

// Gets Ratings and Rankings corresponding to RatingIDs
$ratesql=	"SELECT
		IFNULL((SELECT rating,
         FROM ratingpr
         WHERE ratingprid = $prid
         ),0) AS pronerate,
    	IFNULL((SELECT rank,
         FROM rankingpr
         WHERE ratingprid = $prid
         ),0) AS pronerank, 
		IFNULL((SELECT rating
         FROM rating3p
         WHERE rating3pid = $3pid
         ),0) AS 3prate,
        IFNULL((SELECT ranking
         FROM ranking3p
         WHERE rating3pid = $3pid
         ),0) AS 3prank,
		IFNULL((SELECT rating
         FROM ratingar
         WHERE ratingarid = $arid
         ),0) AS arrate,
        IFNULL((SELECT ranking
         FROM rankingar
         WHERE ratingarid = $arid
         ),0) AS arrank,
		IFNULL((SELECT rating
         FROM ratingap
         WHERE ratingapid = $apid
         ),0) AS aprate,
        IFNULL((SELECT ranking
         FROM rankingap
         WHERE ratingapid = $apid
         ),0) AS aprank";

$rate=mysql_query($ratesql) or die(mysql_error());

// Turn the array into some useful php variables
 
while ($row=mysql_fetch_array($rate)) {
			
			$pronerate=$row["pronerate"];
			$3prate=$row["3prate"];
			$arrate=$row["arrate"];
			$aprate=$row["aprate"];
			$pronerank=$row["pronerank"];
			$3prank=$row["3prank"];
			$arrank=$row["arrank"];
			$aprank=$row["aprank"];
?>