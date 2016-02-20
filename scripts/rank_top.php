<?php
// REPLACED BY ADDING LIMIT PARAMETER TO RANK.PHP FUNCTIONS.
// Fetches top 3 ranked competitors in each discipline for Latest Ranking Page Tabs.

// Select top three competitors from each discipline.

// Prone

$rankindexsql = "SELECT MAX(rankindexprID) FROM rankindexpr";
$prindex=mysqli_query($con, $rankindexsql);

$pronesql = "SELECT rating, forename, surname, gender, nationality
FROM ratingpr
INNER JOIN competitor
ON competitor.competitorID = ratingpr.competitorID
INNER JOIN rankingpr
ON rankingpr.ratingprID = ratingpr.ratingprID
WHERE rankingpr.rankindexprID = '$prindex'
ORDER BY rating DESC
LIMIT 3;"

$toppr = mysqli_query($con, $pronesql);

// 3P

$rankindexsql = "SELECT MAX(rankindex3pID) FROM rankindex3p";
$3pindex=mysqli_query($con, $rankindexsql);

$3psql = "SELECT rating, forename, surname, gender, nationality
FROM rating3p
INNER JOIN competitor
ON competitor.competitorID = rating3p.competitorID
INNER JOIN ranking3p
ON ranking3p.rating3pID = rating3p.rating3pID
WHERE ranking3p.rankindex3pID = '$3pindex'
ORDER BY rating DESC
LIMIT 3;"

$top3p = mysqli_query($con, $3psql);

// Air Rifle

$rankindexsql = "SELECT MAX(rankindexarID) FROM rankindexar";
$arindex=mysql_query($rankindexsql);

$arsql = "SELECT rating, forename, surname, gender, nationality
FROM ratingar
INNER JOIN competitor
ON competitor.competitorID = ratingar.competitorID
INNER JOIN rankingar
ON rankingar.ratingarID = ratingpr.ratingarID
WHERE rankingar.rankindexarID = '$arindex'
ORDER BY rating DESC
LIMIT 3;"

$topar = mysqli_query($con, $arsql);

// Air Pistol

$rankindexsql = "SELECT MAX(rankindexapID) FROM rankindexap";
$apindex=mysqli_query($con, $rankindexsql);

$apsql = "SELECT rating, forename, surname, gender, nationality
FROM ratingap
INNER JOIN competitor
ON competitor.competitorID = ratingap.competitorID
INNER JOIN rankingap
ON rankingap.ratingapID = ratingap.ratingapID
WHERE rankingap.rankindexapID = '$apindex'
ORDER BY rating DESC
LIMIT 3;"

$topap = mysqli_query($con, $apsql);

?>