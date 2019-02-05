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
	
	if (isset($_GET['v']))
	{
		$sql = "SELECT vastaus FROM vastaukset WHERE ID = " . $_GET['v'];
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				echo $row["vastaus"];
			}
		} 
		else 
		{
			
		}
	}
	
	if (isset($_GET['k']))
	{
		$sql = "SELECT vID FROM kysymykset WHERE kysymys LIKE '%" . $_GET['k'] . "%' LIMIT 1";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				echo $row["vID"];
			}
		} 
		else 
		{
			echo -1;
		}
	}

	$conn->close();
	
?>