<?php
// Fetches top 3 ranked competitors in each discipline

include '../scripts/conn.php';

// Select top three competitors from each discipline.

// Prone

$rankindexsql = "SELECT MAX(rankindexprID) FROM rankindexpr";
$prindex=mysql_query($rankindexsql);

$pronesql = "SELECT rating, forename, surname, gender, nationality
FROM ratingpr
INNER JOIN competitor
ON competitor.competitorID = ratingpr.competitorID
INNER JOIN rankingpr
ON rankingpr.ratingprID = ratingpr.ratingprID
WHERE rankingpr.rankindexprID = '$prindex'
ORDER BY rating DESC
LIMIT 3;"

$toppr = mysql_query($pronesql);

// 3P

$rankindexsql = "SELECT MAX(rankindex3pID) FROM rankindex3p";
$3pindex=mysql_query($rankindexsql);

$3psql = "SELECT rating, forename, surname, gender, nationality
FROM rating3p
INNER JOIN competitor
ON competitor.competitorID = rating3p.competitorID
INNER JOIN ranking3p
ON ranking3p.rating3pID = rating3p.rating3pID
WHERE ranking3p.rankindex3pID = '$3pindex'
ORDER BY rating DESC
LIMIT 3;"

$top3p = mysql_query($3psql);

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

$topar = mysql_query($arsql);

// Air Pistol

$rankindexsql = "SELECT MAX(rankindexapID) FROM rankindexap";
$apindex=mysql_query($rankindexsql);

$apsql = "SELECT rating, forename, surname, gender, nationality
FROM ratingap
INNER JOIN competitor
ON competitor.competitorID = ratingap.competitorID
INNER JOIN rankingap
ON rankingap.ratingapID = ratingap.ratingapID
WHERE rankingap.rankindexapID = '$apindex'
ORDER BY rating DESC
LIMIT 3;"

$topap = mysql_query($apsql);

?>