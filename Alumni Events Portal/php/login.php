/*
Author: Andrew Nguyen
This file will check to see if the credentials are in the alumni office db.

If true, proceed to the alumnioffice webpage
Otherwise, refresh the page

*/
<?php
$conn = oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
if($conn) {
$user = $_GET['username'];
  $pass = $_GET['password'];
	$query = oci_parse($conn, "create table dummy(username varchar(20) PRIMARY KEY, pass varchar(20))");
	oci_execute($query);
	$query2 = oci_parse($conn, "insert into dummy values('$user', '$pass')");
	oci_execute($query2);
	$query3 = oci_parse($conn, "select dummy.username, userpass.username from dummy, userpass where dummy.username = userpass.username and dummy.pass = userpass.pass");
	oci_execute($query3);
	
  if (oci_fetch($query3)) {
    header("Location:http://linux.students.engr.scu.edu/~anguyen/alumnioffice.html");
  }
  else {
	header("Location:http://linux.students.engr.scu.edu/~anguyen/login.html");
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
