<?php
	require("serverCon.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>NATURE</title>
		<link rel="icon" href="icon.png" type="image/x-icon"/>
		<link rel="stylesheet" href="stylecss.css">
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
			require("menu.php")
		?>
		<div class="container">
			<form method="post" enctype="multipart/form-data">
				<div>
					<h2 style="text-align:center">Iscriviti</h2>
						<input type="text" placeholder="Nome" name="Nome2" value="" />
						<input type="password" placeholder="Password" name="Password2" value=""/><br>
						<input type="text" placeholder="email" name="email" value="" />
						<input type="text" placeholder="anno di nascita" name="anno_nascita" value="" />
						<input type="text" placeholder="professione" name="profes" value="" /><br>
						<h2> </h2>
						<span>Foto:</span><input type="file" name="image" /><br>
						<h1> </h1>
				</div>
				<input class="button" type="button" value="Torna Indietro" onclick="location.href='index.php';">
				<input class="button "type="submit" name="submit" value="Iscriviti">
			</form>

			<?php

				if(isset($_POST['submit']) && isset($_POST['Nome2']) && isset($_POST['Password2']) && isset($_POST['email'])
					&& isset($_POST['anno_nascita']) && isset($_POST['profes'])){
						if($_POST['Nome2'] != "" && $_POST['Password2'] != "" && $_POST['email'] != "" && $_POST['anno_nascita'] != "" && $_POST['profes'] != ""){
						$nome = $_POST['Nome2'];
						$pass = $_POST['Password2'];

						$str = str_replace('', '_', $nome);//sql iniection
						$name2 = preg_replace("/[^a-zA-Z0-9_-]/", "", $str);

						if($nome == $name2 && strlen($pass) > 7){
							$salt = substr($nome,0,2);

							$pass = crypt($pass, $salt);

							$sql = "SELECT nome, password
									FROM utente
									WHERE nome = '$nome'
									AND password = '$pass'";
							$ok = mysqli_query($conn, $sql);

							if($ok && (mysqli_num_rows($ok) != 0)) {
								echo "<div><p>Nome Utente o Password non valide</p></div>";
							}else{
								//session_start();
								if(session_status() == PHP_SESSION_NONE){session_start();}
								session_unset();
								session_destroy();

								session_start();

								$sql = "INSERT INTO utente
								(nome, password, email, anno_nascita, profes, foto, data_reg, tipo) values
								('$nome', '$pass', '".$_POST['email']."', ".$_POST['anno_nascita'].", '".$_POST['profes']."', ";
								if($_FILES['image']['tmp_name'] != "" && getimagesize($_FILES['image']['tmp_name']) != FALSE){
									$image = addslashes($_FILES['image']['tmp_name']);
									$image = file_get_contents($image);
									$image = base64_encode($image);
									$sql = $sql."'".$image."'";
								} else {
									$sql = $sql."NULL";
								}
								$sql = $sql.", '".date("Y/m/d")."', 'semplice')";

//echo $sql;

								$ok = mysqli_query($conn, $sql);
								if(!$ok) {
									echo "<div><p>Errore iscrizione</p></div>";
								} else {
									//require("start.php");
									header("Location: index.php");
								}
							}
						}else{
							echo "<div class=\"w3-container w3-center\"><p>Nome Utente o Password non valide</p></div>";
						}
					}else{
					echo "<div class=\"w3-container w3-center\"><p>Nome Utente o Password non valide</p></div>";
					}
				}
			?>
		</div>
	</body>
</html>
