<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Event</title>

</head>

<?php
include '../scripts/conn.php';

$sql="SELECT meetingID, meetingname FROM meeting";
$result=mysql_query($sql);

$options="";

while ($row=mysql_fetch_array($result)) {

    $meetingid=$row["meetingID"];
    $mname=$row["meetingname"];
    $options.="<OPTION VALUE=\"$meetingid\">".$mname;
}


$dsql="SELECT disciplineID, name FROM discipline";
$dresult=mysql_query($dsql);

$doptions="";

while ($row=mysql_fetch_array($dresult)) {

    $disciplineid=$row["disciplineID"];
    $disciplinename=$row["name"];
    $doptions.="<OPTION VALUE=\"$disciplineid\">".$disciplinename;
}
?>

<body>

<form id="addevent"
	action = "addevent.php"

        method = "post">

     <fieldset>


     <legend>Add Event</legend>


     <p>
       <label>Meeting</label>

       <select name = "eventmeeting">

       <option value=0>Choose

       <?=$options?> 

       </select>

     </p>

     <p>

       <label>Event Name</label>

       <input type = "text"

             name = "eventname"

     </p>



     <p>
       <label>Discipline</label>

       <select name = "eventdiscipline">

       <option value=0>Choose

       <?=$doptions?> 

       </select>

     </p>

     <p>
       <label>Gender</label>

       <select name = "gender">

       <option value = "1">Men</option>

       <option value = "2">Women</option>

       <option value = "3">Mixed</option>
	   
	   <option value = "4">Junior Men</option>
	   
	   <option value = "3">Junior Women</option>

       </select>

     </p>

     <p>

       <label>Entrants</label>

       <input type = "text"

             name = "entrants"

     </p>

	 <p></p>

       <input type = "submit"

              value = "Add Event" />

    </fieldset>

 </body>

</html>


