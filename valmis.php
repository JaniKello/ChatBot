<html>
<body>
<form action="olemassaoleva.php?ID=<?php echo $_GET['ID'];?>" method="post">
Liitä olemassa oleva vastaus id:llä <input type="text" name="Vastaus" /><br><br>
<input type="submit" />
</form>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "ChatBot";
	$conn = new mysqli($servername, $username, $password, $database); 
	$query = mysqli_query($conn, "SELECT * FROM `kysymykset` WHERE `vID` = '1'");
	$vast = mysqli_query($conn, "SELECT * FROM `Vastaukset`");
	if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
	}
	echo "<table border='1'>
		<tr>
		<th>ID</th>
		<th>Vastaus</th>
		</tr>";

		while($row = mysqli_fetch_array($vast))
		{
		echo "<tr>";
		echo "<td>" . $row['ID'] . "</td>";
		echo "<td>" . $row['Vastaus'] . "</td>";
		echo "</tr>";
		}
		echo "</table>";
exit();
?>
</body>
</html>