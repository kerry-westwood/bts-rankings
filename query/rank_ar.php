<?php
// Fetches latest Air Rifle ranking for Latest Ranking Page.

include '../scripts/conn.php';

// Select latest Air Rifle ranking ID.

$rankindexsql = "SELECT MAX(rankindexarID) FROM rankindexar";
$arindex=mysql_query($rankindexsql);

// Select all competitors, ordered by rating.

$arsql = "SELECT rating, forename, surname, gender, nationality
FROM ratingar
INNER JOIN competitor
ON competitor.competitorID = ratingar.competitorID
INNER JOIN rankingar
ON rankingar.ratingarID = ratingpr.ratingarID
WHERE rankingar.rankindexarID = '$arindex'
ORDER BY rating DESC;"

$topar = mysql_query($arsql);

?>
