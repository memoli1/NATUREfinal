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
				$sql = "INSERT INTO `presente` (`nome_lat`, `nome_hab`)
				VALUES ('".$_POST['nome_lat']."', '".$_POST['nome_hab']."')";
				$ok = mysqli_query($conn, $sql);
				if(!$ok) {
					echo "<div><p>Errore</p></div>";
				} else {
					echo "<div><p>successo: ".$_POST['nome_lat']." in ".$_POST['nome_hab']."</p></div>";
				}
			}
		?>
		<form method="post">
			<div>
				<hr>
				<span>scegli la fauna:</span>
				<select name="nome_lat">
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
				<h1></h1>
				<h1></h1>
				<span>scegli l'habitat:</span>
				<select name="nome_hab">
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
					echo "</div>";
					echo "</div>";
				?>
				</select><br>
			</div>
			<h1></h1>
			<input class="button" type="submit" name="submit" value="aggiungi fauna al habitat" />
		</form>
	</body>
</html>
