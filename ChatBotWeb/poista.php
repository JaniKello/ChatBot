<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "ChatBot";
	$conn = new mysqli($servername, $username, $password, $database); 
	
	
	$ID = $_GET['ID'];
	$delete = "DELETE FROM `kysymykset` WHERE `kysymykset`.`ID` = '$ID'";
	if (mysqli_query($conn, $delete)) {
		echo "Kysymys poistettu";
		header('Location: AdminPage.html'); //If book.php is your main page where you list your all records
		exit;
		
} else {
    echo "Error deleting record";
}
	
?>