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

			if(isset($_POST['escursione']) && $_POST['escursione'] != "NULL"){

				$appStr = explode(" ", $_POST['escursione']);
				$sql = "INSERT INTO `partecipa` (`nome`, `nome_crea_esc`, `data_esc`)
				VALUES ('".$_SESSION['Nome']."', '".$appStr[0]."', '".$appStr[1]."')";

				$ok = mysqli_query($conn, $sql);
				if(!$ok) {
					echo "<div><p>Errore invio messaggio</p></div>";
				}
				echo "messaggio inviato correttamente";
			}
		?>
		<hr>
		<form method="post">
			<div>
				<span>scegli l'escursione:</span>
				<select name="escursione">
				<option value="NULL">Scegli escursione</option>
				<?php
				/*tutte le escursioni non mie, quelle a cui non ho gia deciso di partecipare e quelle con gia raggiunto il numero massimo*/
					$sql = "SELECT nome_creatore, data_part
							FROM escursione e left join partecipa p on (e.nome_creatore = p.nome_crea_esc AND e.data_part = p.data_esc)
							WHERE nome_creatore <> '".$_SESSION['Nome']."'
							AND NOT EXISTS(
								SELECT *
								FROM partecipa
								WHERE nome = '".$_SESSION['Nome']."'
								)
							GROUP BY nome_creatore, data_part, num_max
							HAVING num_max > count(*)";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						while($riga = mysqli_fetch_array($ok)){
							echo "<option value=\"".$riga['nome_creatore']." ".$riga['data_part']."\">di: ".$riga['nome_creatore'].", data: ".$riga['data_part']."</option>";
						}
					}
					echo "</div>";
					echo "</div>";
				?>
				</select><br>
			</div>
			<h1></h1>
			<input class="button" type="submit" id="button" value="adesisci">
		</form>
	</body>
</html>
