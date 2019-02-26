<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "chatbot";
	$conn = new mysqli($servername, $username, $password, $database); 
	$query = mysqli_query($conn, "INSERT INTO vastaukset (Vastaus) VALUES ('$_POST[Vastaus]')");
	if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
echo"Vastaus lisätty tietokantaan!";

$lastid = mysqli_insert_id($conn);
echo "last id : ".$lastid;
	 $vID = mysqli_query($conn, "UPDATE kysymykset SET vID = '" . $lastid . "' WHERE ID = '" . $_GET['ID'] . "'");
exit();
?>