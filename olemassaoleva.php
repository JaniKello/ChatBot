<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "chatbot";
	$conn = new mysqli($servername, $username, $password, $database); 

	$query = mysqli_query($conn, "UPDATE kysymykset SET vID = ('$_POST[Vastaus]') WHERE ID = '" . $_GET['ID'] ."'");
	if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
echo"Vastaus jolla on id = '" . $_GET['ID'] . "' on lisätty vastaus jossa on id = '" . $_POST['Vastaus'] . "'";
exit();
?>