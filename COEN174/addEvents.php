<?php
$conn = oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
if($conn) {
  
  $a = $_GET['eventname'];
  $b = $_GET['organizer'];
  $c = $_GET['location'];
  $d = $_GET['eventDate'];
  $e = $_GET['eventDescription'];
  $query = oci_parse($conn, "insert into alumnievents values(eventsId.nextVal, '$a', '$b', '$c', '$d','$e')");

  if (oci_execute($query) == true) {
    header("Location:http://linux.students.engr.scu.edu/~anguyen/alumni.html");
  }
  else {
    echo "Unable to Add Event";
  }
} else {
       $e = oci_error;
       print "<br> connection failed:";
       exit;
}
OCILogoff($conn);
?>
