<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Query Database</title>

</head>

<?php
include '../scripts/conn.php';

$eventsql="SELECT eventID, name FROM event";
$eventresult=mysql_query($eventsql);

$eventoptions="";

while ($row=mysql_fetch_array($eventresult)) {

    $eventid=$row["eventID"];
    $ename=$row["name"];
    $eventoptions.="<OPTION VALUE=\"$eventid\">".$ename."</option>";
}


$compsql="SELECT compID, surname, forename FROM competitor ORDER BY surname";
$compresult=mysql_query($compsql);

$compoptions="";

while ($row=mysql_fetch_array($compresult)) {

    $compid=$row["compID"];
    $compsur=$row["surname"];
    $compfor=$row["forename"];
    $compname=$compsur.", ".$compfor;
    $compoptions.="<OPTION VALUE=\"$compid\">".$compname;
}

?>

<body>

<form id="events"
	action = "eventquery.php"

        method = "post">

    <fieldset>


     <legend>Search by Event</legend>


     <p>
       <label>Events:</label>

       <select name = "shootevent">

       <option value=0>Choose</option>

       <?=$eventoptions?> 

       </select>

     </p>
       <input type = "submit"

             value = "Find Shoots" />

    </fieldset>



<form id="competitor"
	action = "compquery.php"

        method = "post">

    <fieldset>


     <legend>Search by Competitor Name</legend>


     <p>
       <label>Competitors:</label>

       <select name = "competitor">

       <option value=0>Choose

       <?=$compoptions?> 

       </select>

     </p>
       <input type = "submit"

             value = "Show Shooter" />

    </fieldset>


<form id="nationality"
	action = "nationquery.php"

        method = "post">


    <fieldset>


     <legend>Browse by Nationality</legend>


     <p>

       <label>Nationality:</label>

       <select name = "nationality">


       <option value = "ENG">England</option>

       <option value = "SCO">Scotland</option>

       <option value = "WAL">Wales</option>

       <option value = "NIR">Northern Ireland</option>

       <option value = "IRL">Ireland</option>

       <option value = "IOM">Isle of Man</option>

       <option value = "GUE">Guernsey</option>

       <option value = "JER">Jersey</option>

       <option value = "Other">Other</option>

       </select>

     </p>

       <input type = "submit"

             value = "Find Competitors" />


    </fieldset>


 </body>

</html>


