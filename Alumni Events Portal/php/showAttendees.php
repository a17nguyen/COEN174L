/*
Author: Andrew Nguyen
This file will show the attendees that attended an event based on the eventid

*/


<?php
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
showAttendees();
function  showAttendees(){

	$conn=oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}	
    $a = $_GET['eventId'];	
	//shows the title, author, category and highlights of the books	
	$query = oci_parse($conn, "select * from checkin where eventid = '$a'");
	// Execute the query
	oci_execute($query);

	$query2 = oci_parse($conn, "select eventname from alumnievents where eventsid = '$a'");
	// Execute the query
	oci_execute($query2);
	$row2 = oci_fetch_array($query2, OCI_BOTH);
	
	$tempvar = 0;
	
	$query3 = oci_parse($conn, "select count(eventid) from checkin where eventid = '$a'");
	// Execute the query
	oci_execute($query3);
	$row3 = oci_fetch_array($query3, OCI_BOTH);
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {		
		// We can use either numeric indexed starting at 0 
		// or the column name as an associative array index to access the colum value
		// Use the uppercase column names for the associative array indices
		if($tempvar == 0){
			echo "<br>";
			echo "<div class=\"container\" style=\"border: 1.5px solid; border-radius: 8px; padding: 0px;\"><h2 style=\"background-color: #b50043; color: white; padding: 15px; margin: 
0px;\">", " EventName: $row2[0]";
			echo "</h2></br>";
			$tempvar = 1;
		}

		echo "<p style=\"padding: 0px 15px;\">Name:", "<font color='blue'> $row[2]  $row[3] </font></br>";
		echo "Graduation Year:", "<font color='blue'> $row[4] </font></br>";
		echo "Major:", "<font color='blue'> $row[5] </font></br>";
		echo "Email:", "<font color='blue'> $row[0] </font></br>";
		echo "<br>";	
	}
echo "Number of Attendees:", "<font color='blue'> $row3[0] </font></br>";
echo "</div>";


	OCILogoff($conn);	
	
	
}



?>
