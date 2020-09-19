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

			if(isset($_POST['data_inizio']) && isset($_POST['descrizione']) && isset($_POST['importo_massimo'])){
				if($_POST['data_inizio'] != "" && $_POST['descrizione'] != "" && $_POST['importo_massimo'] != ""){

					$sql = "INSERT INTO `campagna_fondi` (`data_inizio`, `descrizione`, `importo_massimo`)
					VALUES ('".$_POST['data_inizio']."', '".$_POST['descrizione']."', '".$_POST['importo_massimo']."')";

					$ok = mysqli_query($conn, $sql);
					if(!$ok) die("<div><p>Errore creazione campagna</p></div>");
					echo "campagna creata correttamente";
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
		?>
		<div class="card text-white bg-success mb-3 mt-4">
		<div class="w3-container w3-center">
			<hr>
		<form method="post">
			<div>
				<span>Data inizio: </span><input type="text" placeholder="Data inizio" name="data_inizio"><br>
				<span>Descrizione: </span><textarea placeholder="Descrizione" name="descrizione" rows="10" cols="60" maxlength="200"></textarea><br>
				<span>Importo massimo: </span><input type="text" placeholder="Importo massimo" name="importo_massimo"><br>
			</div>
			<input class="button" type="submit" id="button" value="Crea campagna">
		</form>
	</div>
	</div>
	</body>
</html>
