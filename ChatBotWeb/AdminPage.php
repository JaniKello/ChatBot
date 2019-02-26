<script>

var idTaul = [];

function AddID(id)
{
	idTaul.push(id);
}

function AddEventListener()
{	
	for (var i = 0; i < idTaul.length; i++)
	{
		var id = idTaul[i];
		var input = document.getElementById(id);
		input.setAttribute("onkeydown", "if (event.keyCode == 13) { UpdateQ(" + id + "); }");
	}
}

</script>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "ChatBot";
	$conn = new mysqli($servername, $username, $password, $database); 
	$query = mysqli_query($conn, "SELECT * FROM `kysymykset` WHERE `vID` = '1'");
	$vast = mysqli_query($conn, "SELECT * FROM `Vastaukset`");
	
	if (!$query) 
	{
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	
	if (isset($_GET['m']) && isset($_GET['v']))
	{

		mysqli_query($conn, "UPDATE Vastaukset SET Vastaus = '" . $_GET['v'] . "' WHERE ID = " . $_GET['m']);
		header("Refresh:0; url=AdminPage.php");
	}
	else
	{
	
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
				
				echo "<script>AddID(" . $row['ID'] . ")</script>";
				
				echo "<tr>";
				echo "<td>" . $row['ID'] . "</td>";
				echo "<td><input id=" . $row['ID'] . " type='text' value='" . $row['Vastaus'] . "'>" . "</td>";
				echo '<td><a class="btn btn-default" onclick="return deleteQ()" href="vastauspoista.php?ID='.$row['ID'].'">Poista vastaus</a></td>';
				echo "</tr>";
			}
			echo "</table>";
			
			echo "<script>AddEventListener()</script>";
	}

mysqli_close($conn);
?>
<button id="Paluu">Poistu</button>


<script>

function deleteQ()
{
	var del=confirm("Haluatko varmasti poistaa kysymyksen?");
	if (del == true){
	   alert ("Kysymys poistettu")
	}
	return del;
}

function UpdateQ(id)
{
	var input = document.getElementById(id);
	window.location.href = "AdminPage.php?m=" + id + "&v=" + input.value;
}

var btn = document.getElementById('Paluu');
btn.addEventListener('click', function() {
  document.location.href = 'chatbot.html';
});

</script>
	