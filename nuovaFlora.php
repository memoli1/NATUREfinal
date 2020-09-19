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

			if(isset($_POST['nome_lat']) && isset($_POST['classe']) && isset($_POST['nome_specie'])
				&& isset($_POST['livello_vulne']) && isset($_POST['link_wiki'])){
				if($_POST['nome_lat'] != "" && $_POST['classe'] != "" && $_POST['nome_specie'] != ""
					&& $_POST['livello_vulne'] != "" && $_POST['link_wiki'] != ""){

					$sql = "SELECT nome_lat
							FROM specie
							WHERE nome_lat = '".$_POST['nome_lat']."'";
					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0)) {
						echo "<div><p>nome latino non validi</p></div>";
					}else{

						$sql = "INSERT INTO `specie` (`nome_lat`, `classe`, `nome_specie`, `anno_classif`, `livello_vulne`, `link_wiki`)
						VALUES ('".$_POST['nome_lat']."', '".$_POST['classe']."', '".$_POST['nome_specie']."', ";
						if(isset($_POST['anno_classif']) && $_POST['anno_classif'] != ""){
							$sql = $sql."".$_POST['anno_classif'];
						} else {
							$sql = $sql."NULL";
						}
						$sql = $sql.", '".$_POST['livello_vulne']."', '".$_POST['link_wiki']."')";

						$ok = mysqli_query($conn, $sql);
						if(!$ok) {
							echo "<div><p>Errore registrazione nuova specie</p></div>";
						} else {
							$sql = "INSERT INTO `vegetali` (`nome_lat`, `altezza`, `diametro`)
							VALUES ('".$_POST['nome_lat']."', '".$_POST['altezza']."', '".$_POST['diametro']."')";

							$ok = mysqli_query($conn, $sql);
							if(!$ok) {
								echo "<div><p>Errore registrazione nuova flora</p></div>";
							} else {
								echo "<div><p>nuova flora inserita correttamente</p></div>";

								$sql = "INSERT INTO `modifica_specie` (`nome_lat`, `nome_amm`, `azione`)
								VALUES ('".$_POST['nome_lat']."', '".$_SESSION['Nome']."', 'creazione')";

								$ok = mysqli_query($conn, $sql);
								if(!$ok) {
									echo "<div><p>Errore registrazione modifica</p></div>";
								}

								/*$collection = (new MongoDB\Client)->NATURA->log;
								$result = $collection->insertOne([
									'nome' => $_SESSION['Nome'],
									'azione' => 'creazione',
									'tipo' => 'flora',
									'id' => $_POST['nome_lat']});*/
							}
						}
					}
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
			echo "</div>";
			echo "</div>";
		?>
		<div class="container">
		<form method="post" enctype="multipart/form-data">
			<span>NOME LATINO:</span><input type="text" placeholder="Nome latino" name="nome_lat" value="" /><br>
			<span>CLASSE:</span><input type="text" placeholder="Classe" name="classe" value="" /><br>
			<span>NOME SPECIE:</span><input type="text" placeholder="Nome specie" name="nome_specie" value="" /><br>
			<span>ANNO CLASSIFICAZIONE:</span><input type="text" placeholder="Anno classificazione" name="anno_classif" value="" /><br>
			<span>LIVELLO DI VULNERABILITA':</span><input type="text" placeholder="Livello vulnerabilità" name="livello_vulne" value="" /><br>
			<span>LINK WIKIPEDIA:</span><input type="text" placeholder="Link wikipedia" name="link_wiki" value="" /><br>
			<span>ALTEZZA:</span><input type="text" placeholder="Altezza" name="altezza" value="" /><br>
			<span>DIAMETRO:</span><input type="text" placeholder="Diametro" name="diametro" value="" /><br>

			<input class="button" type="submit" name="submit" value="Inserisci dati">
		</form>
		</div>
	</body>
</html>
