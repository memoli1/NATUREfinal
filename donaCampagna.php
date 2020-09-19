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

		<style media="screen">
		input[type=text], input[type=password] {
		width: 50%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
		}

		.button {
		background-color: #4CAF50; /* Green */
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		}

		button:hover {
		opacity: 0.8;
		}

		span.psw {
		float: right;
		padding-top: 16px;
		}

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


			if(isset($_POST['camp']) && isset($_POST['Importo'])){
				if($_POST['Importo'] != ""){
					$sql = "SELECT c.importo_massimo, IFNULL(sum(d.importo), 0) as importo_raccolto
							FROM campagna_fondi c left join donazione d on(c.id_camp = d.id_camp)
							WHERE c.id_camp = '".$_POST['camp']."'
							GROUP BY c.id_camp, c.importo_massimo
							HAVING IFNULL(sum(d.importo), 0) < c.importo_massimo";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						$riga = mysqli_fetch_array($ok);
						if($riga['importo_massimo']-$riga['importo_raccolto'] >= $_POST['Importo']){
							$sql = "INSERT INTO `donazione` (`nome`, `id_camp`, `importo`)
							VALUES ('".$_SESSION['Nome']."', '".$_POST['camp']."', '".$_POST['Importo']."')";

							$ok = mysqli_query($conn, $sql);
							if(!$ok) die("<div><p>Errore donazione</p></div>");
							echo "donazione effettuata correttamente";
						} else {
							echo "<div><p>importo troppo alto</p></div>";
						}
					} else {
						echo "<div><p>Errore donazione</p></div>";
					}
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
			echo "</div>";
			echo "</div>";
		?>
		<hr>
		<form method="post">
			<div class="container">
				<span>scegli la campagna:</span>
				<select name="camp">
				<?php
					$sql = "SELECT c.id_camp, c.importo_massimo, IFNULL(sum(d.importo), 0) as importo_raccolto
							FROM campagna_fondi c left join donazione d on(c.id_camp = d.id_camp)
							WHERE c.stato = 0
							GROUP BY c.id_camp, c.importo_massimo
							HAVING IFNULL(sum(d.importo), 0) < c.importo_massimo";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						while($riga = mysqli_fetch_array($ok)){
							echo "<option value=\"".$riga['id_camp']."\">".$riga['id_camp'].", importo mancante: ".($riga['importo_massimo']-$riga['importo_raccolto'])."</option>";
						}
					}
				?>
				</select><br>
				<span>Importo:</span><input type="text" placeholder="Importo" name="Importo"><br>

			<input class="button" type="submit" id="button" value="Dona">
			</div>
		</form>
	</body>
</html>
