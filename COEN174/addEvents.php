<?php
$conn = oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
if($conn) {
  
  $a = $_GET['eventname'];
  $b = $_GET['firstname'];
  $c = $_GET['lastname'];
  $d = $_GET['gradyear'];
  $e = $_GET['major'];
  $f = $_GET['location'];
  $g = $_GET['eventDate'];
  $h = $_GET['eventDescription'];
  $query = oci_parse($conn, "create table dummy(firstname varchar(20), lastname varchar(20), gradYear int, major varchar(50))");
	oci_execute($query);
	$query2 = oci_parse($conn, "insert into dummy values('$b', '$c', '$d', '$e')");
	oci_execute($query2);
	$query3 = oci_parse($conn, "select dummy.firstname, alumnidb.firstname from dummy, alumnidb where upper(dummy.firstname) = upper(alumnidb.firstname) and upper(dummy.lastname) = upper(alumnidb.lastname) and dummy.gradyear = alumnidb.gradyear and upper(dummy.major) = upper(alumnidb.major)");
	oci_execute($query3);

  if (oci_execute($query3) == true) {
$query4 = oci_parse($conn, "insert into alumnievents values(eventsId.nextVal, '$a', '$b', '$c', '$d','$e', '$f', date '$g', '$h')");
oci_execute($query4);
    header("Location:http://linux.students.engr.scu.edu/~anguyen/alumni.html");
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
