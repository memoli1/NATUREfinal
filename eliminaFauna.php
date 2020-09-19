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

			if(isset($_POST['submit']) && $_POST['animale'] != ""){

				$sql = "DELETE FROM `specie` WHERE `nome_lat` = '".$_POST['animale']."'";
				$ok = mysqli_query($conn, $sql);

				if(!$ok) {
					echo "<div><p>errore durante la cancellazione</p></div>";
				}else{
					echo "<div><p>eliminazione avvenuta con successo</p></div>";

					$sql = "INSERT INTO `modifica_specie` (`nome_lat`, `nome_amm`, `azione`)
					VALUES ('".$_POST['nome_lat']."', '".$_SESSION['Nome']."', 'eliminazione')";

					$ok = mysqli_query($conn, $sql);
					if(!$ok) {
						echo "<div><p>Errore registrazione modifica</p></div>";
					}

					/*$collection = (new MongoDB\Client)->NATURA->log;
					$result = $collection->insertOne([
						'nome' => $_SESSION['Nome'],
						'azione' => 'eliminazione',
						'tipo' => 'fauna',
						'id' => $_POST['nome_lat']});*/
				}
			}
		?>
		<div class="card text-white bg-success mb-3 mt-4">
		<div class="w3-container w3-center">
		<form method="post">
			<div>
				<hr>
				<span>scegli l'habitat:</span>
				<select name="animale">
				<?php
					$sql = "SELECT nome_lat
							FROM animali";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						while($riga = mysqli_fetch_array($ok)){
							echo "<option value=\"".$riga['nome_lat']."\">".$riga['nome_lat']."</option>";
						}
					}
				?>
				</select><br>
			</div>
			<h1></h1>
			<input class="button" type="submit" name="submit" value="elimina animale" />
		</form>
	</div>
	</div>
	</body>
</html>
