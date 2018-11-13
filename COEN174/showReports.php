<?php

echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';

showReports();
function  showReports(){
	$conn=oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	$createTable = oci_parse($conn, "Create Table Temp(eventsId int, eventsName varchar(30))");
	oci_execute($createTable);
	$query = oci_parse($conn, "insert into temp select checkin.eventId, Alumnievents.eventName from checkin inner join AlumniEvents on checkIn.eventId = Alumnievents.eventsId order by checkin.eventId");
	// Execute the query
	oci_execute($query);
	$query2 = oci_parse($conn, "select count(*) as NumberOfAttendees, eventsId from Temp group by eventsId order by eventsId");
	$query3 = oci_parse($conn, "select eventName, eventsId from Alumnievents where eventsId in (select eventId from checkin)");
	oci_execute($query3);
	echo"Status Report (To be modified with better UI display)";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<div class=\"container\">";
	echo"<b>Event id corresponding to event name</b>";
	echo "<br><table class=\"table\">";
	echo "<thead><tr><th>Event ID</th><th>Event Name</th></tr></thead><tbody>";
	while (($row = oci_fetch_array($query3, OCI_BOTH)) != false) {		
		// We can use either numeric indexed starting at 0 
		// or the column name as an associative array index to access the colum value
		// Use the uppercase column names for the associative array indices
		if($row[1] == NULL)
			echo "Title: N/A";
		else
			echo "<tr><td><font color='blue'> $row[1] </font></td>";
		if($row[0] == NULL)
			echo "Author: N/A";
		else
			echo "<td><font color='blue'> $row[0] </font></td></tr>";
	}
	echo "</tbody></table>";
	oci_execute($query2);
	
echo "<br>";
	echo "<br>";
	echo "<b>Number of Attendees per event</b>";
	echo "<br><table class=\"table\">";
	echo "<thead><tr><th>Event ID</th><th>Number of Attendees</th></tr></thead><tbody>";
	while (($row = oci_fetch_array($query2, OCI_BOTH)) != false) {		
		// We can use either numeric indexed starting at 0 
		// or the column name as an associative array index to access the colum value
		// Use the uppercase column names for the associative array indices
		echo "<br>";
		if($row[1] == NULL)
			echo "Title: N/A";
		else
			echo "<tr><td><font color='blue'> $row[1] </font></td>";
		if($row[0] == NULL)
			echo "Author: N/A";
		else
			echo "<td><font color='blue'> $row[0] </font></td></tr>";
	}
echo "</div>";
$query4 = oci_parse($conn, "drop table temp");
oci_execute($query4);


	OCILogoff($conn);	
	
	
}



?>
