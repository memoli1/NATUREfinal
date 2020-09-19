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

			if(isset($_POST['nome']) && isset($_POST['descrizione'])){
				if($_POST['nome'] != "" && $_POST['descrizione'] != ""){

					$sql = "SELECT nome
							FROM habitat
							WHERE nome = '".$_POST['nome']."'";
					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0)) {
						echo "<div><p>nome non valido</p></div>";
					}else{

						$sql = "INSERT INTO `habitat` (`nome`, `descrizione`)
						VALUES ('".$_POST['nome']."', '".$_POST['descrizione']."')";
						$ok = mysqli_query($conn, $sql);
						if(!$ok) {
							echo "<div><p>Errore registrazione nuovo habitat</p></div>";
						} else {
							echo "<div><p>nuovo habitat inserito correttamente</p></div>";

							$sql = "INSERT INTO `modifica_habitat` (`nome_hab`, `nome_amm`, `azione`)
							VALUES ('".$_POST['nome']."', '".$_SESSION['Nome']."', 'creazione')";

							$ok = mysqli_query($conn, $sql);
							if(!$ok) {
								echo "<div><p>Errore registrazione modifica</p></div>";
							}

							/*$collection = (new MongoDB\Client)->NATURA->log;
							$result = $collection->insertOne([
								'nome' => $_SESSION['Nome'],
								'azione' => 'creazione',
								'tipo' => 'habitat',
								'id' => $_POST['nome']});*/
						}
					}
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
		?>
		<div class="card text-white bg-success mb-3 mt-4">
		<div class="w3-container w3-center">
			<hr>
		<form method="post" enctype="multipart/form-data">
			<span>Nome:</span><input type="text" placeholder="Nome" name="nome" value="" /><br>
			<span>Descrizione:</span><input type="text" placeholder="Descrizione" name="descrizione" value="" /><br>

			<input class="button" type="submit" name="submit" value="Inserisci dati" />
		</form>
	</div>
	</div>
	</body>
</html>
