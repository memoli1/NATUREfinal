<?php
	require("serverCon.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>NATURE</title>
		<link rel="icon" href="icon.png" type="image/x-icon"/>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

		<style>
		div.container
		{
		display: block;
		text-align: center;
		}
		</style>

	</head>
	<body>
		<?php
			require("menu.php");
			echo "<div class=\"card text-white bg-success mb-3 mt-4\">";
			echo "<div class=\"w3-container w3-center\">";

			$sql = "SELECT nome_creatore, titolo, data_part, ora_part, ora_ritor, tragitto, descrizione, num_max
					FROM escursione
					";
			/*
			$sql = "SELECT nome_creatore, titolo, data_part, ora_part, ora_ritor, tragitto, descrizione, num_max
					FROM escursione
					where nome_creatore <> '".$_SESSION['Nome']."'";
			*/

			$ok = mysqli_query($conn, $sql);

			if($ok && (mysqli_num_rows($ok) != 0))
			{
				$count = 1;
				while($riga = mysqli_fetch_array($ok)){
					echo "<h2>".$count."° Escursione</h2>
					<p>nome creatore: ".$riga['nome_creatore']."</p>
					<p>titolo: ".$riga['titolo']."</p>
					<p>data partenza: ".$riga['data_part']."</p>
					<p>ora partenza: ".$riga['ora_part']."</p>
					<p>ora ritorno: ".$riga['ora_ritor']."</p>
					<p>tragitto: ".$riga['tragitto']."</p>
					<p>descrizione: ".$riga['descrizione']."</p>
					<p>numero massimo di partecipanti: ".$riga['num_max']."</p>";
					$count+=1;
				}
			}
		//	echo "</div>";
		//	echo "</div>";
		?>
	</body>
</html>
