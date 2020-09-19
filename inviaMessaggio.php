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

			if(isset($_POST['dest']) && isset($_POST['Messaggio']) && isset($_POST['Titolo'])){
				if($_POST['Messaggio'] != "" && $_POST['Titolo'] != ""){

					$sql = "INSERT INTO messaggio (`nome_sorg`, `nome_dest`, `timestamp`, `titolo`, `testo`)
					VALUES ('".$_SESSION['Nome']."', '".$_POST['dest']."', current_timestamp(), '".$_POST['Titolo']."', '".$_POST['Messaggio']."')";

					$ok = mysqli_query($conn, $sql);
					if(!$ok) {
						echo "<div><p>Errore invio messaggio</p></div>";
					} else {
						echo "messaggio inviato correttamente";
					}
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
		?>
		<form method="post">
			<div>
				<hr>
				<span>SCEGLI DESTINATARIO:</span>
				<select name="dest">
				<?php
					$sql = "SELECT nome
							FROM utente
							WHERE nome <> '".$_SESSION['Nome']."'";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						while($riga = mysqli_fetch_array($ok)){
							echo "<option value=\"".$riga['nome']."\">".$riga['nome']."</option>";
						}
					}
					echo "</div>";
					echo "</div>";
				?>
				<div class="container">
				</select><br>
				<input type="text" placeholder="Titolo" name="Titolo"><br>
				<textarea placeholder="Messaggio" name="Messaggio" rows="10" cols="60" maxlength="200"></textarea>
			</div>
			<input class="button" type="submit" id="button" value="invia messaggio">
		</form>
		</div>
	</body>
</html>
