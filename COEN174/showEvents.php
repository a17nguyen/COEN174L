<?php
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
showEvents();
function  showEvents(){
	$conn=oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	//shows the title, author, category and highlights of the books	
	$query = oci_parse($conn, "select * from alumnievents order by eventdate asc");
	// Execute the query
	oci_execute($query);
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {		
		// We can use either numeric indexed starting at 0 
		// or the column name as an associative array index to access the colum value
		// Use the uppercase column names for the associative array indices
		echo "<br>";
		echo "<div class=\"container\" style=\"border: 1.5px solid; border-radius: 8px; padding: 0px;\"><h2 style=\"background-color: #b50043; color: white; padding: 15px; margin: 
0px;\">", " $row[1]";
        echo "<span style=\"float: right;\">EventId:", " $row[0] </span></h2></br>";
		echo "<p style=\"padding: 0px 15px;\">Organizer Name:", "<font color='blue'> $row[2]  $row[3] </font></br>";
		echo "Location:", "<font color='blue'> $row[6] </font></br>";
		echo "Date:", "<font color='blue'> $row[7] </font></br>";
		echo "Description:", "<font color='blue'> $row[8] </font></p></div></br>";
		echo "<br>";	
	}


	OCILogoff($conn);	
	
	
}



?>
