<?php
// Fetches latest Air Pistol ranking

include '../scripts/conn.php';

// Select latest Air Pistol ranking ID.

$rankindexsql = "SELECT MAX(rankindexapID) FROM rankindexap";
$apindex=mysql_query($rankindexsql);

// Select all competitors, ordered by rating.

$apsql = "SELECT rating, forename, surname, gender, nationality
FROM ratingap
INNER JOIN competitor
ON competitor.competitorID = ratingap.competitorID
INNER JOIN rankingap
ON rankingap.ratingapID = ratingap.ratingapID
WHERE rankingap.rankindexapID = '$apindex'
ORDER BY rating DESC;"

$topap = mysql_query($apsql);

?>
