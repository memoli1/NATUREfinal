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

			$sql = "SELECT id_camp, stato, data_inizio, descrizione, importo_massimo
					FROM campagna_fondi";

			$ok = mysqli_query($conn, $sql);

			if($ok && (mysqli_num_rows($ok) != 0))
			{
				$count = 1;
				while($riga = mysqli_fetch_array($ok)){
					echo "<h2>".$count."° CAMPAGNA</h2>
					<p>ID: ".$riga['id_camp']."</p>
					<p>DATA INIZIO: ".$riga['data_inizio']."</p>
					<p>DESCRIZIONE: ".$riga['descrizione']."</p>
					<p>IMPORTO MASSIMO: ".$riga['importo_massimo']."</p>";
					$count+=1;
				}
			}
			echo "</div>";
			echo "</div>";
		?>
	</body>
</html>
