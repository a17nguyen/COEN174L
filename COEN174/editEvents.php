<?php
$conn = oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
if($conn) {
  
  $a = $_GET['eventid'];
  $n = $_GET['eventname'];
  $b = $_GET['firstname'];
  $c = $_GET['lastname'];
  $d = $_GET['gradyear'];
  $e = $_GET['major'];
  $f = $_GET['location'];
  $g = $_GET['eventDate'];
  $h = $_GET['eventDescription'];
  $query4 = oci_parse($conn, "update alumnievents set location ='$f', eventDate = date '$g', eventsDescription = '$h', eventName = '$n' where upper(firstname) = upper('$b') and upper(lastname) = upper('$c') and upper(gradyear) = upper('$d') and upper(major) = upper('$e') and eventsid = '$a'");
oci_execute($query4);
  if (oci_execute($query4) == true) {

    header("Location:http://linux.students.engr.scu.edu/~anguyen/alumni.html");
  }
  else {
    echo "Unable to Edit Event";
  }
} else {
       $e = oci_error;
       print "<br> connection failed:";
       exit;
}
OCILogoff($conn);
?>
