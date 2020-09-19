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

			if(isset($_POST['submit'])){
				if($_POST['classe'] != "" || $_POST['nome_specie'] != "" || $_POST['anno_classif'] != ""
				|| $_POST['livello_vulne'] != "" || $_POST['link_wiki'] != ""
				|| $_POST['altezza'] != "" || $_POST['diametro'] != ""){
					if($_POST['classe'] != "" || $_POST['nome_specie'] != "" || $_POST['anno_classif'] != ""
						|| $_POST['livello_vulne'] != "" || $_POST['link_wiki'] != ""){
						$sql = "UPDATE `specie` SET ";
						if($_POST['classe'] != ""){
							$sql = $sql."`classe` = '".$_POST['classe']."', ";
						}
						if($_POST['nome_specie'] != ""){
							$sql = $sql."`nome_specie` = '".$_POST['nome_specie']."', ";
						}
						if($_POST['anno_classif'] != ""){
							$sql = $sql."`anno_classif` = '".$_POST['anno_classif']."', ";
						}
						if($_POST['livello_vulne'] != ""){
							$sql = $sql."`livello_vulne` = '".$_POST['livello_vulne']."', ";
						}
						if($_POST['link_wiki'] != ""){
							$sql = $sql."`link_wiki` = '".$_POST['link_wiki']."', ";
						}
						$sql = substr($sql, 0, -2);
						$sql = $sql." WHERE `nome_lat` = '".$_POST['nome_lat']."'";

						$ok = mysqli_query($conn, $sql);

						if(!$ok) {
							echo "<div><p>fauna non modificata</p></div>";
						} else {
							echo "<div><p>specie modificata</p></div>";
						}
					}
					if($_POST['altezza'] != "" || $_POST['diametro'] != ""){
						$sql = "UPDATE `vegetali` SET ";
						if($_POST['altezza'] != ""){
							$sql = $sql."`altezza` = '".$_POST['altezza']."', ";
						}
						if($_POST['diametro'] != ""){
							$sql = $sql."`diametro` = '".$_POST['diametro']."', ";
						}
						$sql = substr($sql, 0, -2);

						$sql = $sql." WHERE `nome_lat` = '".$_POST['nome_lat']."'";

						$ok = mysqli_query($conn, $sql);

						if(!$ok) {
							echo "<div><p>fauna non modificata</p></div>";
						} else {
							echo "<div><p>fauna modificata</p></div>";
						}
					}

					$sql = "INSERT INTO `modifica_specie` (`nome_lat`, `nome_amm`, `azione`)
					VALUES ('".$_POST['nome_lat']."', '".$_SESSION['Nome']."', 'modifica')";

					$ok = mysqli_query($conn, $sql);
					if(!$ok) {
						echo "<div><p>Errore registrazione modifica</p></div>";
					}

					/*$collection = (new MongoDB\Client)->NATURA->log;
						$result = $collection->insertOne([
							'nome' => $_SESSION['Nome'],
							'azione' => 'modifica',
							'tipo' => 'fauna',
							'id' => $_POST['nome_lat']});*/
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
		?>
		<hr>
		<form method="post">
			<div>
				<span>SCEGLI LA PIANTA:</span>
				<select name="nome_lat">
				<?php
					$sql = "SELECT nome_lat
							FROM vegetali";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						while($riga = mysqli_fetch_array($ok)){
							echo "<option value=\"".$riga['nome_lat']."\">".$riga['nome_lat']."</option>";
						}
					}

					echo "</div>";
					echo "</div>";
				?>
				</select><br>
				<span>CLASSE:</span><input type="text" placeholder="Classe" name="classe" value="" /><br>
				<span>NOME SPECIE:</span><input type="text" placeholder="Nome specie" name="nome_specie" value="" /><br>
				<span>ANNO CLASSIFICAZIONE:</span><input type="text" placeholder="Anno classificazione" name="anno_classif" value="" /><br>
				<span>LIVELLO VULNERABILITA:</span><input type="text" placeholder="Livello vulnerabilità" name="livello_vulne" value="" /><br>
				<span>LINK WIKIPEDIA:</span><input type="text" placeholder="Link wikipedia" name="link_wiki" value="" /><br><br>

				<span>ALTEZZA:</span><input type="text" placeholder="Altezza" name="altezza" value="" /><br>
				<span>DIAMETRO:</span><input type="text" placeholder="Diametro" name="diametro" value="" /><br>
			</div>
			<input class="button" type="submit" name="submit" value="Modifica flora" />
		</form>

	</body>
</html>
