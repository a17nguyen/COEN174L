<?php
$conn = oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
if($conn) {
  
  $a = $_GET['eventid'];
  $b = $_GET['firstname'];
  $c = $_GET['lastname'];
  $d = $_GET['officeid'];
  $query = oci_parse($conn, "create table dummy(officeid int, firstname varchar(20), lastname varchar(20))");
	oci_execute($query);
	$query2 = oci_parse($conn, "insert into dummy values('$d', '$b', '$c')");
	oci_execute($query2);
	$query3 = oci_parse($conn, "select dummy.firstname, alumnioffice.firstname from dummy, alumnioffice where upper(dummy.firstname) = upper(alumnioffice.firstname) and upper(dummy.lastname) = upper(alumnioffice.lastname) and dummy.officeid = alumnioffice.officeid");
	oci_execute($query3);

  if (oci_execute($query3) == true) {
$query4 = oci_parse($conn, "insert into alumnievents (eventsid, eventname, firstname, lastname, gradyear, location, eventdate, eventsdescription) select eventsid, eventname, firstname, lastname, gradyear, location, eventdate, eventsdescription from pendingevents where pendingevents.eventsid = '$a'");
oci_execute($query4);
$query5 = oci_parse($conn, "delete from pendingevents where eventsid = '$a'");
oci_execute($query5);
    header("Location:http://linux.students.engr.scu.edu/~anguyen/alumnioffice.html");
  }
  else {
    echo "Unable to Add Event";
  }
	$drop = oci_parse($conn, "drop table dummy");
	oci_execute($drop);
} else {
       $e = oci_error;
       print "<br> connection failed:";
       exit;
}
OCILogoff($conn);
?>
