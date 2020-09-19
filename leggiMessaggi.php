<?php
	require("serverCon.php");
	require("sessionCon.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>NATURE</title>
		<link rel="icon" href="icon.png" type="image/x-icon"/>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	</head>
	<body>
		<?php
			require("menu.php");
			echo "<div class=\"card text-white bg-success mb-3 mt-4\">";
			echo "<div class=\"w3-container w3-center\">";

			$sql = "SELECT nome_sorg, timestamp, titolo, testo
					FROM messaggio
					WHERE nome_dest = '".$_SESSION['Nome']."'";

			$ok = mysqli_query($conn, $sql);

			if($ok && (mysqli_num_rows($ok) != 0))
			{
				$count = 1;
				while($riga = mysqli_fetch_array($ok)){
					echo "<h2>".$count."° Messagio</h2>
					<p>DA: ".$riga['nome_sorg']."</p>
					<p>TIMESTAMP: ".$riga['timestamp']."</p>
					<p>TITOLO: ".$riga['titolo']."</p>
					<p>TESTO: ".$riga['testo']."</p>";
					$count+=1;
				}
			}
			echo "</div>";
			echo "</div>";
		?>
	</body>
</html>
