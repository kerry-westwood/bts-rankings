<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Score</title>

</head>

<?php
include '../scripts/conn.php';

$shootsql="SELECT shootID, meetingname, year, eventname, type
FROM shoot, event, meeting
WHERE shoot.eventID = event.eventID
AND event.meetingID = meeting.meetingID
ORDER BY shootID DESC";
$shootresult=mysql_query($shootsql);

$shootoptions="";

while ($row=mysql_fetch_array($shootresult)) {

    $shootid=$row["shootID"];
    $mname=$row["meetingname"];
	$year=$row["year"];
	$ename=$row["eventname"];
	$type=$row["type"];
    $shootname=$mname." ".$year.", ".$ename.", ".$type;
	$shootoptions.="<OPTION VALUE=\"$shootid\">".$shootname;
}


$compsql="SELECT competitorID, surname, forename, nationality FROM competitor ORDER BY surname";
$compresult=mysql_query($compsql);

$compoptions="";

while ($row=mysql_fetch_array($compresult)) {

    $compid=$row["competitorID"];
    $compsur=$row["surname"];
    $compfor=$row["forename"];
    $compnat=$row["nationality"];
    $compname=$compsur.", ".$compfor." (".$compnat.")";
    $compoptions.="<OPTION VALUE=\"$compid\">".$compname;
}
?>

<body>

<form id="addscore"
	action = "addscore.php"

        method = "post">

     <fieldset>


     <legend>Add Score</legend>


     <p>
       <label>Shoot</label>

       <select name = "shoot">

       <option value=0>Choose

       <?=$shootoptions?> 

       </select>

     </p>

     <p>
       <label>Competitor</label>

       <select name = "competitor">

       <option value=0>Choose

       <?=$compoptions?> 

       </select>

     </p>
		 
	 
     <table border="1" width="100">
     <tr>
     <td></td>
     <td>1</td>
     <td>2</td>
     <td>3</td>
     <td>4</td>
     <td>5</td>
     <td>6</td>
     <td>Qualification</td>
     <td>F1</td>
	 <td>F2</td>
	 <td>F3</td>
	 <td>F4</td>
	 <td>F5</td>
	 <td>F6</td>
	 <td>F7</td>
	 <td>F8</td>
	 <td>F9</td>
	 <td>F10</td>
	 <td>F11</td>
	 <td>F12</td>
	 <td>F13</td>
	 <td>F14</td>
	 <td>F15</td>
	 <td>F16</td>
	 <td>F17</td>
	 <td>F18</td>
	 <td>F19</td>
	 <td>F20</td>
	 <td>Final</td>
	 <td>Penalties</td>
     <td>Position</td>
     </tr>
     <tr>
     <td>Strings</td>
     <td><input type = "text"

             name = "q1"</td>
     <td><input type = "text"

             name = "q2"</td>
     <td><input type = "text"

             name = "q3"</td>
     <td><input type = "text"

             name = "q4"</td>
     <td><input type = "text"

             name = "q5"</td>
     <td><input type = "text"

             name = "q6"</td>
     <td><input type = "text"

             name = "qtotal"</td>
  	 <td><input type = "text"

             name = "f1"</td>
	 <td><input type = "text"

             name = "f2"</td>
	 <td><input type = "text"

             name = "f3"</td>
	 <td><input type = "text"

             name = "f4"</td>
	 <td><input type = "text"

             name = "f5"</td>
	 <td><input type = "text"

             name = "f6"</td>
	 <td><input type = "text"

             name = "f7"</td>
	 <td><input type = "text"

             name = "f8"</td>
	 <td><input type = "text"

             name = "f9"</td>
	 <td><input type = "text"

             name = "f10"</td>
	 <td><input type = "text"

             name = "f11"</td>
	 <td><input type = "text"

             name = "f12"</td>
	 <td><input type = "text"

             name = "f13"</td>
	 <td><input type = "text"

             name = "f14"</td>
	 <td><input type = "text"

             name = "f15"</td>
	 <td><input type = "text"

             name = "f16"</td>
	 <td><input type = "text"

             name = "f17"</td>
	 <td><input type = "text"

             name = "f18"</td>
	 <td><input type = "text"

             name = "f19"</td>
	 <td><input type = "text"

             name = "f20"</td>
	 <td><input type = "text"

             name = "final"</td>
	 <td><input type = "text"

             name = "penalties"</td>
     <td><input type = "text"

             name = "position"</td>
     </tr></table> 


     <p>
       <label>Notes</label>
       <textarea name = "notes"></textarea>
     </p>


       <input type = "submit"

             value = "Add Score" />

    </fieldset>
</form>
</body>

</html>


