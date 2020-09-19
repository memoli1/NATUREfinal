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
	width: 70%;
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

			if(isset($_POST['Titolo']) && isset($_POST['data_part']) && isset($_POST['ora_part']) && isset($_POST['ora_ritor'])
				&& isset($_POST['Tragitto']) && isset($_POST['Descrizione']) && isset($_POST['num_max'])){
				if($_POST['Titolo'] != "" && $_POST['data_part'] != "" && $_POST['ora_part'] != "" && $_POST['ora_ritor'] != ""
				&& $_POST['Tragitto'] != "" && $_POST['Descrizione'] != "" && $_POST['num_max'] != ""){

					$sql = "INSERT INTO `escursione` (`nome_creatore`, `titolo`, `data_part`, `ora_part`, `ora_ritor`, `tragitto`, `descrizione`, `num_max`)
					VALUES ('".$_SESSION['Nome']."', '".$_POST['Titolo']."', '".$_POST['data_part']."', '".$_POST['ora_part']."', '".$_POST['ora_ritor']."',
					'".$_POST['Tragitto']."', '".$_POST['Descrizione']."', ".$_POST['num_max'].")";

					$ok = mysqli_query($conn, $sql);
					if(!$ok) {
						echo "<div><p>Errore creazione escursione</p></div>";
					}
					echo "escursione creata correttamente";
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
			echo "</div>";
			echo "</div>";
		?>
		<form method="post">
			<div class="container">
				<span>Titolo: </span><input type="text" placeholder="Titolo" name="Titolo"><br>
				<span>Data partenza: </span><input type="text" placeholder="Data partenza" name="data_part"><br>
				<span>Ora partenza: </span><input type="text" placeholder="Ora partenza" name="ora_part"><br>
				<span>Ora ritorno: </span><input type="text" placeholder="Ora ritorno" name="ora_ritor"><br>
				<span>Tragitto: </span><textarea placeholder="Tragitto" name="Tragitto" rows="10" cols="60" maxlength="200"></textarea><br>
				<span>Descrizione: </span><textarea placeholder="Descrizione" name="Descrizione" rows="10" cols="60" maxlength="200"></textarea><br>
				<span>Numero massimo partecipanti: </span><input type="text" placeholder="Numero massimo" name="num_max"><br>
				<input class="button" type="submit" id="button" value="crea escursione">
			</div>
			
		</form>
	</body>
</html>
