<?php
	// ini_set('display_errors', '0');

	if (isset($_POST['k']))
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "chatbot";
			
		
		$conn = new mysqli($servername, $username, $password, $dbname); //mysqli_connect
			
		if ($conn->connect_error) 
		{
			die("Connection failed");
		}

		$sql = "INSERT INTO kysymykset (Kysymys, vID) VALUES ('" . $_POST['k'] . "', '1')";
				
		if ($conn->query($sql) === TRUE) 
		{
			// echo "New record created successfully";
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
?>