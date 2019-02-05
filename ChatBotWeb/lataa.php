<?php
	// ini_set('display_errors', '0');
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "chatbot";
	
	
	$conn = new mysqli($servername, $username, $password, $dbname); //mysqli_connect
	
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT kysymys, vID FROM kysymykset";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
			echo $row["kysymys"] . "_" . $row["vID"] . "\n";
		}
	} 
	else 
	{
		
	}

	$conn->close();
	
?>