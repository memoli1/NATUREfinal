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

			if(isset($_POST['submit']) && isset($_POST['descrizione'])){
				if($_POST['descrizione'] != ""){

					$sql = "UPDATE `habitat`
					SET `descrizione` = '".$_POST['descrizione']."'
					WHERE `nome` = '".$_POST['habitat']."'";
					$ok = mysqli_query($conn, $sql);

					if(!$ok) {
						echo "<div><p>habitat non modificato</p></div>";
					}else{
						echo "<div><p>habitat modificato</p></div>";

						$sql = "INSERT INTO `modifica_habitat` (`nome_hab`, `nome_amm`, `azione`)
						VALUES ('".$_POST['habitat']."', '".$_SESSION['Nome']."', 'modifica')";

						$ok = mysqli_query($conn, $sql);
						if(!$ok) {
							echo "<div><p>Errore registrazione modifica</p></div>";
						}

						/*$collection = (new MongoDB\Client)->NATURA->log;
						$result = $collection->insertOne([
							'nome' => $_SESSION['Nome'],
							'azione' => 'modifica',
							'tipo' => 'habitat',
							'id' => $_POST['habitat']});*/
					}
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
				<span>scegli l'habitat:</span>
				<select name="habitat">
				<?php
					$sql = "SELECT nome
							FROM habitat";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						while($riga = mysqli_fetch_array($ok)){
							echo "<option value=\"".$riga['nome']."\">".$riga['nome']."</option>";
						}
					}
				?>
				</select><br>
			</div>
			<input type="text" name="descrizione" placeholder="Descrizione" />
			<input class="button" type="submit" name="submit" value="modifica habitat" />
		</form>
	</div>
	</div>
	</body>
</html>
