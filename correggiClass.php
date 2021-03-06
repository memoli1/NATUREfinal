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

			if(isset($_POST['submit'])){
				$sql = "UPDATE `segnalazione`
					SET `nome_spec` = '".$_POST['specie']."'
					WHERE `id_segn` = '".$_POST['segnalazione']."'";
				$ok = mysqli_query($conn, $sql);

				if(!$ok) {
					echo "<div><p>segnalazione non modificata</p></div>";
				}else{
					echo "<div><p>segnalazione modificata</p></div>";
				}
			}
		?>
		<div class="card text-white bg-success mb-3 mt-4">
		<div class="w3-container w3-center">
			<hr>
		<form method="post">
			<div>
				<span>scegli la segnalazione:</span>
				<select name="segnalazione">
				<?php
					$sql = "SELECT id_segn
							FROM segnalazione
							WHERE nome_spec IS NOT NULL";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						while($riga = mysqli_fetch_array($ok)){
							echo "<option value=\"".$riga['id_segn']."\">".$riga['id_segn']."</option>";
						}
					}
				?>
				</select><br>
				<span>scegli la specie:</span>
				<select name="specie">
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
				?>
				</select><br>
			</div>
			<input class="button" type="submit" name="submit" value="modifica classificazione" />
		</form>
	</div>
	</div>
	</body>
</html>
