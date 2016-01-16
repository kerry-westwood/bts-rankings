<?php
// Fetches latest 3P ranking for Latest Ranking Page.

include '../scripts/conn.php';

// Select latest 3P ranking ID.

$rankindexsql = "SELECT MAX(rankindex3pID) FROM rankindex3p";
$3pindex=mysql_query($rankindexsql);

// Select all competitors, ordered by rating.

$3psql = "SELECT rating, forename, surname, gender, nationality
FROM rating3p
INNER JOIN competitor
ON competitor.competitorID = rating3p.competitorID
INNER JOIN ranking3p
ON ranking3p.rating3pID = rating3p.rating3pID
WHERE ranking3p.rankindex3pID = '$3pindex'
ORDER BY rating DESC;"

$top3p = mysql_query($3psql);

?>
