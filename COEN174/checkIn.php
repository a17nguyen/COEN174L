<?php
$conn = oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
if($conn) {
  
  $a = $_GET['email'];
  $b = $_GET['eventId'];
  $c = $_GET['firstname'];
  $d = $_GET['lastname'];
  $e = $_GET['gradyear'];
  $f = $_GET['major'];
  $query = oci_parse($conn, "insert into checkin values('$a', '$b', '$c', '$d', '$e', '$f')");
  if (oci_execute($query) == true) {
    header("Location:http://linux.students.engr.scu.edu/~anguyen/alumni.html");
  }
  else {
    echo "Unable to Check In";
  }
} else {
       $e = oci_error;
       print "<br> connection failed:";
       exit;
}
OCILogoff($conn);
?>
