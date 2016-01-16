<?php
// Fetches latest prone ranking for Latest Ranking Page.

include '../scripts/conn.php';

// Select latest prone ranking ID.

$rankindexsql = "SELECT MAX(rankindexprID) FROM rankindexpr";
$prindex=mysql_query($prindexsql);

// Select all competitors, ordered by rating.

$pronesql = "SELECT rating, forename, surname, gender, nationality
FROM ratingpr
INNER JOIN competitor
ON competitor.competitorID = ratingpr.competitorID
INNER JOIN rankingpr
ON rankingpr.ratingprID = ratingpr.ratingprID
WHERE rankingpr.rankindexprID = '$prindex'
ORDER BY rating DESC;"

$pronerank=mysql_query($pronesql);

?>
