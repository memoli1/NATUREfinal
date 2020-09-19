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

			$sql = "SELECT data, foto, latitudine, longitudine, nome_hab, nome_utente, nome_spec
					FROM segnalazione";

			$ok = mysqli_query($conn, $sql);

			if($ok && (mysqli_num_rows($ok) != 0))
			{
				$count = 1;
				while($riga = mysqli_fetch_array($ok)){
					echo "<h2>".$count."° Segnalazione</h2>
					<p>data: ".$riga['data']."</p>
					<span>foto: </span><img src=\"data:image;base64,".$riga['foto']."\" width=\"100px\" height=\"100px\"><br>
					<p>latitudine: ".$riga['latitudine']."</p>
					<p>longitudine: ".$riga['longitudine']."</p>
					<p>habitat: ".$riga['nome_hab']."</p>
					<p>utente che ha fatto la segnalazione: ".$riga['nome_utente']."</p>
					<p>specie: ".$riga['nome_spec']."</p>";
					$count+=1;
				}
			}
			echo "</div>";
			echo "</div>";
		?>
	</body>
</html>
