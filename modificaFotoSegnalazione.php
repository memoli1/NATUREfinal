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
			if(isset($_POST['submit']) && isset($_POST['id_segn'])){
				if($_POST['id_segn'] != "" && $_FILES['image']['tmp_name'] != "" && getimagesize($_FILES['image']['tmp_name']) != FALSE){
					$image = addslashes($_FILES['image']['tmp_name']);
					$image = file_get_contents($image);
					$image = base64_encode($image);

					$sql = "UPDATE segnalazione
							SET foto='".$image."'
							WHERE id_segn='".$_POST['id_segn']."'";

					$ok = mysqli_query($conn, $sql);
					if(!$ok) {
						echo "<div><p>Errore inserimento dati</p></div>";
					} else {
						echo "<div><p>modifica avvenuta correttamente</p></div>";
					}
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
		?>
		<hr>
		<form method="post" enctype="multipart/form-data">

			<span>scegli la segnalazione:</span>
				<select name="id_segn">
				<?php
					$sql = "SELECT id_segn
							FROM segnalazione
							WHERE nome_utente = '".$_SESSION['Nome']."'";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						while($riga = mysqli_fetch_array($ok)){
							echo "<option value=\"".$riga['id_segn']."\">".$riga['id_segn']."</option>";
						}
					}
					echo "</div>";
					echo "</div>";
				?>
				</select><br>
				<input type="file" name="image" />

			<input class="button" type="submit" name="submit" value="Modifica">
		</form>
	</body>
</html>
