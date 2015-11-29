<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Shoot</title>

</head>

<?php
include '../scripts/conn.php';

$sql="SELECT eventID, meetingname, eventname FROM event, meeting WHERE event.meetingID = meeting.meetingID";
$result=mysql_query($sql);

$options="";

while ($row=mysql_fetch_array($result)) {

    $eventid=$row["eventID"];
    $ename=$row["meetingname"].", ".$row["eventname"];
    $options.="<OPTION VALUE=\"$eventid\">".$ename;
}

?>

<body>

<form id="addshoot"
	action = "addshoot.php"

        method = "post">

     <fieldset>


     <legend>Add Shoot</legend>


     <p>
       <label>Event</label>

       <select name = "shootevent">

       <option value=0>Choose

       <?=$options?> 

       </select>

     </p>

     <p>
       <label>Type</label>

       <select name = "shoottype">

       <option value = "1">Elimination 1</option>
	   
	   <option value = "2">Elimination 2</option>
	   
	   <option value = "3">Elimination 3</option>
	   
	   <option value = "4">Elimination 4</option>
	   
	   <option value = "5">Elimination 5</option>

       <option value = "6">Qualification & Final</option>

       <option value = "7">Badges Match</option>

       </select>

     </p>

     <p>
 
       <label>Start Date/Time (YYYY-MM-DD HH:MM:SS)  </label>

       <input type = "date"

              name = "shootdate"

     </p>

	 <p></p>
	 
       <input type = "submit"

              value = "Add Shoot" />

    </fieldset>

 </body>

</html>


