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
			
			if(isset($_POST['Data']) && isset($_POST['Latitudine']) && isset($_POST['Longitudine'])){
				if($_POST['Data'] != "" && $_POST['Latitudine'] != "" && $_POST['Longitudine'] != ""
				&& $_FILES['image']['tmp_name'] != "" && getimagesize($_FILES['image']['tmp_name']) != FALSE){
					
					$image = addslashes($_FILES['image']['tmp_name']);
					$image = file_get_contents($image);
					$image = base64_encode($image);

					$sql = "INSERT INTO segnalazione (`data`, `foto`, `latitudine`, `longitudine`, `nome_hab`, `nome_utente`, `nome_spec`)
					VALUES ('".$_POST['Data']."', '".$image."', '".$_POST['Latitudine']."', '".$_POST['Longitudine']."',
					'".$_POST['Habitat']."', '".$_SESSION['Nome']."', NULL)";

					$ok = mysqli_query($conn, $sql);
					if(!$ok) {
						echo "<div><p>Errore invio segnalazione</p></div>";
					} else {
						$sql = "SELECT num_segn
								FROM utente
								WHERE nome='".$_SESSION['Nome']."'";

						$ok = mysqli_query($conn, $sql);
						if(!$ok){
							echo "<div><p>Errore aggiornamento profilo</p></div>";
						} else {
							$riga = mysqli_fetch_array($ok);
							
							$sql = "UPDATE utente
									SET num_segn=".($riga['num_segn'] + 1)."
									WHERE nome='".$_SESSION['Nome']."'";
									
							$ok = mysqli_query($conn, $sql);
							if(!$ok){
								echo "<div><p>Errore aggiornamento profilo</p></div>";
							}
							
							echo "segnalazione inviata correttamente";
						}
					}
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
		?>
		<form method="post" enctype="multipart/form-data">
			<span>Data: </span><input type="text" placeholder="Data" name="Data" value="" /><br>
			<span>Foto: </span><input type="file" name="image" /><br>
			<span>Latitudine: </span><input type="text" placeholder="Latitudine" name="Latitudine" value="" /><br>
			<span>Longitudine: </span><input type="text" placeholder="Longitudine" name="Longitudine" value="" /><br>
			<span>Scegli un'habitat:</span><select name="Habitat">
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
			<h1></h1>
			<span>Scegli una specie:</span><select name="Specie">
			<?php
				$sql = "SELECT nome_lat
						FROM specie";
						
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
			<h1></h1>
			<input class="button" type="submit" id="button" value="Aggiungi" />
		</form>
	</body>
</html>