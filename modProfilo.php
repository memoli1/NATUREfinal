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
				width: 70%;
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

			if(isset($_POST['email']) && isset($_POST['anno_nascita']) && isset($_POST['profes'])){
				if($_POST['email'] != "" && $_POST['anno_nascita'] != "" && $_POST['profes'] != ""){

					$sql = "UPDATE utente
							SET email='".$_POST['email']."', anno_nascita=".$_POST['anno_nascita'].",
							profes='".$_POST['profes']."' ";
							if($_FILES['image']['tmp_name'] != "" && getimagesize($_FILES['image']['tmp_name']) != FALSE){
								$image = addslashes($_FILES['image']['tmp_name']);
								$image = file_get_contents($image);
								$image = base64_encode($image);
								$sql = $sql.", foto='".$image."'";
							}
					$sql = $sql." WHERE nome='".$_SESSION['Nome']."'";

					$ok = mysqli_query($conn, $sql);
					if(!$ok) {
						echo "<div><p>Errore inserimento dati</p></div>";
					}
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
		?>
		<form method="post" enctype="multipart/form-data">
			<div>
				<?php
					$sql = "SELECT nome, email, anno_nascita, profes,
					foto, data_reg, tipo, num_segn
							FROM utente
							WHERE nome = '".$_SESSION['Nome']."'";

					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						$riga = mysqli_fetch_array($ok);
						echo "<p>NOME: ".$_SESSION['Nome']."</p>
						<span>EMAIL: </span><input type=\"text\" name=\"email\" value=\"".$riga['email']."\"><br>
						<span>ANNO DI NASCITA: </span><input type=\"text\" name=\"anno_nascita\" value=\"".$riga['anno_nascita']."\"><br>
						<span>PROFESSIONE: </span><input type=\"text\" name=\"profes\" value=\"".$riga['profes']."\"><br>
						<span>FOTO: </span><img src=\"data:image;base64,".$riga['foto']."\" width=\"100px\" height=\"100px\"><br>
						<input type=\"file\" name=\"image\" />
						<p>DATA REGISTRAZIONE: ".$riga['data_reg']."</p>
						<p>TIPO UTENTE: ".$riga['tipo']."</p>
						<p>NUMERO SEGNALAZIONE: ".$riga['num_segn']."</p>";
					}
					echo "</div>";
					echo "</div>";
				?>
			</div>
			<div class="container">
			<input class="button" type="submit" id="button" value="Modifica">
			</div>
		</form>
	</body>
</html>
