/*
Author: Andrew Nguyen
This file will allow the alumni to remove events that they have created


*/
<?php
$conn = oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
if($conn) {
  
  $a = $_GET['eventid'];
  $b = $_GET['firstname'];
  $c = $_GET['lastname'];
  $d = $_GET['gradyear'];
  $e = $_GET['major'];
  $g = $_GET['eventDate'];
  $query4 = oci_parse($conn, "delete from alumnievents where eventDate = date '$g' and upper(firstname) = upper('$b') and upper(lastname) = upper('$c') and gradyear = '$d' and upper(major) = upper('$e') and eventsid = '$a'");
oci_execute($query4);
  if (oci_execute($query4) == true) {

    header("Location:http://linux.students.engr.scu.edu/~anguyen/alumni.html");
  }
  else {
    echo "Unable to Remove Event";
  }
} else {
       $e = oci_error;
       print "<br> connection failed:";
       exit;
}
OCILogoff($conn);
?>
