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
    exit();
}
	
	
	echo "<table border='1' table style='float:left'>
		<tr>
		<th>ID</th>
		<th>Kysymys</th>
		<th>vID</th>
		</tr>";

		while($row = mysqli_fetch_array($query))
		{
		echo "<tr>";
		echo "<td>" . $row['ID'] . "</td>";
		echo "<td>" . $row['Kysymys'] . "</td>";
		echo "<td>" . $row['vID'] . "</td>";
		echo '<td><a class="btn btn-default"  href="vastaus.php?ID='.$row['ID'].'">Lisää vastaus</a></td>';
		echo '<td><a class="btn btn-default"  href="valmis.php?ID='.$row['ID'].'">Lisää valmis vastaus</a></td>';
		echo '<td><a class="btn btn-default" onclick="return deleteQ()" href="poista.php?ID='.$row['ID'].'">Poista kysymys</a></td>';

		echo "</tr>";
		}
		echo "</table>";	
		
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
		echo '<td><a class="btn btn-default" onclick="return deleteQ()" href="vastauspoista.php?ID='.$row['ID'].'">Poista vastaus</a></td>';
		echo "</tr>";
		}
		echo "</table>";

mysqli_close($conn);
?>
<button id="Paluu">Poistu</button>
<script>
function deleteQ(){

var del=confirm("Haluatko varmasti poistaa kysymyksen?");
if (del == true){
   alert ("Kysymys poistettu")
}
return del;
}

var btn = document.getElementById('Paluu');
btn.addEventListener('click', function() {
  document.location.href = 'chatbot.html';
});
</script>
	