<?php

echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';

bookDetails();
function  bookDetails(){
	$conn=oci_connect('anguyen','thuymai123', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	//shows the title, author, category and highlights of the books	
	$query = oci_parse($conn, "select * from alumnievents");
	// Execute the query
	oci_execute($query);
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {		
		// We can use either numeric indexed starting at 0 
		// or the column name as an associative array index to access the colum value
		// Use the uppercase column names for the associative array indices
		echo "<br>";
		if($row[1] == NULL)
			echo "Author: N/A";
		else
			echo "<div class=\"container\" style=\"border: 1.5px solid; border-radius: 8px; padding: 0px;\"><h2 style=\"background-color: #b50043; color: white; padding: 15px; margin: 0px;\">Event Name:", "<font color='blue'> $row[1] </font></br>";
		if($row[0] == NULL)
			echo "Title: N/A";
		else
            echo "<span style=\"float: right;\">EventId:", "<font color='blue'> $row[0] </font></span></h2></br>";
		if($row[2] == NULL)
			echo "Category: N/A";
		else		
			echo "<p style=\"padding: 0px 15px;\">Event Organizer:", "<font color='blue'> $row[2] </font></br>";
		if($row[3] == NULL)
			echo "Comments: N/A";
		else
			echo "Location:", "<font color='blue'> $row[3] </font></br>";
		if($row[4] == NULL)
			echo "Highlights: N/A";
		else
			echo "Date:", "<font color='blue'> $row[4] </font></br>";
		if($row[5] == NULL)
			echo "Highlights: N/A";
		else
			echo "Description:", "<font color='blue'> $row[5] </font></p></div></br>";
		echo "<br>";	
	}


	OCILogoff($conn);	
	
	
}



?>
